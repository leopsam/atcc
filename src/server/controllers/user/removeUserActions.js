'use server'
import { deleteUserByIdService } from '@/server/services/userService'

export default async function removeUserActions(id) {
    try {
        const result = await deleteUserByIdService(id)

        return { success: true, result }
    } catch (error) {
        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique o ID fornecido.' }
        }
        if (error.code === 'P2025') {
            return { success: false, message: 'Usuário não encontrado.' }
        }
        return { success: false, message: `Erro inesperado: ${error.message || 'Tente novamente mais tarde.'}` }
    }
}
