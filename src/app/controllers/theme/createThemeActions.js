'use server'
import { z } from 'zod'
import { createThemeService } from '@/app/services/themeService'
import { themeSchema } from '@/utils/schemas/themeSchema'

export async function createThemeActions(formData) {
    try {
        const formDataObj = {
            name: formData.get('name'),
            description: formData.get('description'),
        }

        const validatedData = themeSchema.parse(formDataObj)

        const result = await createThemeService(validatedData)
        return result
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map(err => `${err.path[0]}: ${err.message}`).join(', ')
            return { success: false, message: `Erro de validação: ${errorMessages}` }
        }

        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique os dados fornecidos.' }
        } else {
            return { success: false, message: 'Erro inesperado ao criar usuário.' }
        }
    }
}
