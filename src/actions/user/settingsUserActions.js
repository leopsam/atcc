'use server'

import { z } from 'zod'
import cloudinary from '../../../cloudinary'
import { getUserByEmailService, updateUserByIdService } from '@/app/services/userService'
import { profileSchema } from '@/utils/schemas/profileSchema'

export async function settingsUserActions(email, formData) {
    try {
        const { data: user } = await getUserByEmailService(email)

        const photoBase64 = formData.get('photo')

        const getPhotoInFormData = async () => {
            if (!photoBase64) {
                return user.photo
            } else {
                const base64Regex = /^data:image\/(jpeg|jpg|png|gif|webp|bmp);base64,/

                if (!base64Regex.test(photoBase64)) {
                    throw new Error('Formato de imagem inválido. Apenas imagens em formato Base64 são permitidas.')
                }
                const base64Data = photoBase64.replace(base64Regex, '')
                const cloudinaryResponse = await cloudinary.uploader.upload(`data:image/jpeg;base64,${base64Data}`, {
                    resource_type: 'image',
                    folder: 'atcc',
                })

                const photoUrlCloudinary = cloudinaryResponse.secure_url

                return photoUrlCloudinary
            }
        }

        const photoUrl = await getPhotoInFormData()

        const formDataObj = {
            name: formData.get('name') || user.name,
            birthDate: formData.get('birthDate') || user.birthDate,
            phone: formData.get('phone') || user.phone,
            email: formData.get('email') || user.email,
            address: formData.get('address') || user.address,
            username: formData.get('username') || user.username,
            photo: photoUrl,
        }

        const validatedData = profileSchema.parse(formDataObj)

        const result = await updateUserByIdService(user.id, validatedData)
        return result
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map(err => `${err.path[0]}: ${err.message}`).join(', ')
            return { success: false, message: `Erro de validação: ${errorMessages}` }
        }

        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique os dados fornecidos.' }
        } else {
            return { success: false, message: error.message }
        }
    }
}
