'use server'
import { z } from 'zod'
import { createTccService } from '@/app/services/tccService'
import { tccSchema } from '@/utils/schemas/tccSchema'

export async function createTccActions(formData) {
    console.log('formData', formData)
    try {
        const formDataObj = {
            advisor: formData.get('advisor'),
            themeId: formData.get('themeId'),
            members: formData.get('members')
            // members: formData.getAll('members[]'), // Se você estiver enviando um array de membros
        };
        console.log('formDataObj', formDataObj)
        console.log('formData', formData)


        //const validatedData = tccSchema.parse(formDataObj)

        const result = await createTccService(validatedData)
        return result
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map(err => `${err.path[0]}: ${err.message}`).join(', ')
            return { success: false, message: `Erro de validação: ${errorMessages}` }
        }

        if (error instanceof TypeError) {
            return { success: false, message: error.message }
        } else {
            return { success: false, message: 'Erro inesperado ao criar Proposta.' }
        }
    }
}
