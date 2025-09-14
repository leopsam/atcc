'use server'
import { deleteThemeByIdService } from '@/server/services/themeService'

export default async function removeThemeActions(id) {
    try {
        const result = await deleteThemeByIdService(id)

        return { success: true, result }
    } catch (error) {
        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique o ID fornecido.' }
        }
        if (error.code === 'P2025') {
            return { success: false, message: 'Tema não encontrado.' }
        }
        return { success: false, message: `Erro inesperado: ${error.message || 'Tente novamente mais tarde.'}` }
    }
}
