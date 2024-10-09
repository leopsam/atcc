import { revalidatePath } from 'next/cache'
import db from '@/utils/db'

export async function allUsersService() {
    try {
        const users = await db.user.findMany()
        return { data: users }
    } catch (error) {
        return { data: [] }
    }
}

export async function createUserService(validatedData) {
    try {
        await db.user.create({
            data: validatedData,
        })

        revalidatePath('/adm/user/read')

        return { success: true, message: 'Usuário criado com sucesso' }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Usuário já existe com este dado único --' + error.meta.target + '--' }
        }
        return { success: false, message: 'Erro ao criar usuário.' }
    }
}

export async function getUserByIdService(id) {
    try {
        const user = await db.user.findUnique({
            where: {
                id,
            },
        })
        if (!user) {
            return { success: false, message: 'Usuário não encontrado' }
        }
        return { success: true, data: user }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Erro de unicidade' }
        }
        return { success: false, message: 'Erro ao buscar usuário' }
    }
}

export async function updateUserByIdService(id, validatedData) {
    try {
        const updateUser = await db.user.update({
            where: {
                id,
            },
            data: validatedData,
        })

        revalidatePath('/adm/user/read')

        return { success: true, message: 'Usuário atualizado com sucesso', data: updateUser }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Erro de unicidade ao atualizar usuário --' + error.meta.target + '--' }
        }
        return { success: false, message: 'Erro ao atualizar usuário' }
    }
}

export async function deleteUserByIdService(id) {
    try {
        await db.user.delete({
            where: {
                id,
            },
        })

        revalidatePath('/adm/user/read')

        return { success: true, message: 'Usuário deletado com sucesso' }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Erro de unicidade ao deletar usuário --' + error.meta.target + '--' }
        }
        return { success: false, message: 'Erro ao deletar usuário' }
    }
}
