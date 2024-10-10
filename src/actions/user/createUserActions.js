'use server'
import bcrypt from 'bcrypt'
import { z } from 'zod'
import cloudinary from '../../../cloudinary'
import { createUserService } from '@/app/services/userService'
import { userSchema } from '@/utils/schemas/userSchema'
import userDefault from '@/utils/userDefault'

export async function createUserActions(formData) {
    try {
        const photoBase64 = formData.get('photo') || userDefault

        const base64Regex = /^data:image\/(jpeg|jpg|png|gif|webp|bmp);base64,/

        if (!base64Regex.test(photoBase64)) {
            throw new Error('Formato de imagem inválido. Apenas imagens em formato Base64 são permitidas.')
        }

        const base64Data = photoBase64.replace(base64Regex, '')
        const cloudinaryResponse = await cloudinary.uploader.upload(`data:image/jpeg;base64,${base64Data}`, {
            resource_type: 'image',
            folder: 'atcc',
        })

        const photoUrl = cloudinaryResponse.secure_url

        const formDataObj = {
            matriculation: formData.get('matriculation'),
            name: formData.get('name'),
            role: formData.get('role'),
            status: formData.get('status'),
            birthDate: formData.get('birthDate'),
            cpf: formData.get('cpf'),
            rg: formData.get('rg'),
            phone: formData.get('phone'),
            email: formData.get('email'),
            address: formData.get('address'),
            username: formData.get('username'),
            password: formData.get('password'),
            photo: photoUrl,
        }

        const validatedData = userSchema.parse(formDataObj)

        const saltRounds = 10
        const hashedPassword = await bcrypt.hash(validatedData.password, saltRounds)

        validatedData.password = hashedPassword

        const result = await createUserService(validatedData)
        return result
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map(err => `${err.path[0]}: ${err.message}`).join(', ')
            return { success: false, message: `Erro de validação: ${errorMessages}` }
        }

        if (error.message.includes('Formato de imagem inválido')) {
            return { success: false, message: error.message } // Erro de formato de imagem inválido
        }

        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique os dados fornecidos.' }
        } else {
            return { success: false, message: `Erro inesperado: ${error.message || 'Tente novamente mais tarde.'}` }
        }
    }
}
