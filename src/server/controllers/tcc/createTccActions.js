'use server'
import { z } from 'zod'
import { createTccService, getByUserIdInMembers } from '@/server/services/tccService'
import { tccSchema } from '@/utils/schemas/tccSchema'
import { cookies } from 'next/headers'

export async function createTccActions(formData) {
    try {
        const validatedData = tccSchema.parse(formData)

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

export async function checkByUserIdInMembers() {
    try {
        const userId = cookies().get('user_id')?.value

        if (!userId) {
            return { success: false, message: 'Usuário não encontrado.' }
        }

        const response = await getByUserIdInMembers(userId)

        if (!response.data) {
            return { success: false }
        } else {
            return { success: true }
        }
    } catch (error) {
        return { success: false, message: 'Erro inesperado ao buscar membros.' }
    }
}
