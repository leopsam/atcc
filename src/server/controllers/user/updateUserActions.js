'use server'
import bcrypt from 'bcrypt'
import { z } from 'zod'
import { getUserByIdService, updateUserByIdService } from '@/server/services/userService'
import { userSchema } from '@/utils/schemas/userSchema'

export async function updateUserActions(id, formData) {
    try {
        const { data: user } = await getUserByIdService(id)

        const formDataObj = {
            matriculation: formData.get('matriculation') || user.matriculation,
            name: formData.get('name') || user.name,
            role: user.role || formData.get('role'),
            status: user.status || formData.get('status'),
            birthDate: formData.get('birthDate') || user.birthDate,
            cpf: formData.get('cpf') || user.cpf,
            rg: formData.get('rg') || user.rg,
            phone: formData.get('phone') || user.phone,
            email: formData.get('email') || user.email,
            address: formData.get('address') || user.address,
            username: formData.get('username') || user.username,
            password: formData.get('password') || user.password,
        }

        const validatedData = userSchema.parse(formDataObj)

        const saltRounds = 10
        const hashedPassword = await bcrypt.hash(validatedData.password, saltRounds)

        validatedData.password = hashedPassword

        const result = await updateUserByIdService(id, validatedData)
        return result
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map(err => `${err.path[0]}: ${err.message}`).join(', ')
            return { success: false, message: `Erro de validação: ${errorMessages}` }
        }

        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique os dados fornecidos.' }
        } else {
            return { success: false, message: `Erro inesperado: ${error.message || 'Tente novamente mais tarde.'}` }
        }
    }
}
