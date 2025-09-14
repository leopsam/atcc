import { revalidatePath } from 'next/cache'
import db from '@/utils/db'
import { NextResponse } from 'next/server'

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

export async function getUserByEmailService(email) {
    const decodedEmail = decodeURIComponent(email)
    try {
        const user = await db.user.findUnique({
            where: {
                email: decodedEmail,
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

export async function getUserByRoleTeacherService() {
    try {
        const teachers = await db.user.findMany({
            where: {
                role: 'TEACHER',
            },
        })
        return { data: teachers }
    } catch (error) {
        return { data: [] }
    }
}

export async function getUserByRoleTeacherServiceJson() {
    try {
        const teachers = await db.user.findMany({
            where: {
                role: 'TEACHER',
            },
        })
        return NextResponse.json({ data: teachers })
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
    }
}

export async function getUserByRoleStudentServiceJson() {
    try {
        const students = await db.user.findMany({
            where: {
                role: 'STUDENT',
            },
        })
        return NextResponse.json({ data: students })
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
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
