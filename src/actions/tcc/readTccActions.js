'use server'
import { getTccByUserId } from '@/app/services/tccService'
import { getThemeByIdService } from '@/app/services/themeService'
import { getUserByIdService } from '@/app/services/userService'
import { cookies } from 'next/headers'

export async function getTccInfoByUserIdInMembers() {
    try {
        const userId = cookies().get('user_id')?.value

        if (!userId) {
            return { success: false, message: 'Usuário não encontrado.' }
        }

        const myTcc = await getTccByUserId(userId)
        if (!myTcc.success) {
            return { success: false, message: 'TCC não encontrado.' }
        }

        const myAdvisor = await getUserByIdService(myTcc.data.advisor)
        if (!myAdvisor.success) {
            return { success: false, message: 'Orientador não encontrado.' }
        }

        const myTheme = await getThemeByIdService(myTcc.data.themeId)
        if (!myTheme.success) {
            return { success: false, message: 'Tema não encontrado.' }
        }

        const memberNames = []

        for (const memberId of myTcc.data.members) {
            const result = await getUserByIdService(memberId)

            if (result.success && result.data?.name) {
                memberNames.push(result.data.name)
            } else {
                memberNames.push('Desconhecido')
            }
        }

        const data = {
            advisor: myAdvisor.data.name,
            theme: myTheme.data.name,
            description: myTheme.data.description,
            members: memberNames,
            createdAt: myTcc.data.createdAt,
        }

        return { data: data, success: true }
    } catch (error) {
        return { success: false, message: 'Erro inesperado ao buscar membros.' }
    }
}
