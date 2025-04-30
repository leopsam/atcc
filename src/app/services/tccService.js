import { revalidatePath } from 'next/cache'
import db from '@/utils/db'

export async function allThemesService(page, searchTerm, searchType) {
    try {
        const where = {}
        if (searchTerm) {
            where.name = {
                contains: searchTerm,
                mode: 'insensitive',
            }
        }
        if (searchType) {
            where.type = searchType
        }
        const perPage = 8
        const skip = (page - 1) * perPage
        const totalItems = await db.theme.count({ where })
        const totalPages = Math.ceil(totalItems / perPage)
        const prev = page > 1 ? page - 1 : null
        const next = page < totalPages ? page + 1 : null

        const themes = await db.theme.findMany({
            take: perPage,
            skip,
            where,
            orderBy: { createdAt: 'desc' },
        })

        return { data: themes, prev, next, totalPages }
    } catch (error) {
        return { data: [], prev: null, next: null }
    }
}

export async function allThemesToSelectedService() {
    try {
        const themes = await db.theme.findMany()
        return { data: themes }
    } catch (error) {
        return { data: [] }
    }
}

export async function createTccService(validatedData) {
    try {
        await db.tcc.create({
            data: validatedData,
        })

        revalidatePath('/student/tcc/read')

        return { success: true, message: 'Proposta criado com sucesso' }
    } catch (error) {
        return { success: false, message: 'Erro ao criar Proposta.' }
    }
}

export async function getThemeByIdService(id) {
    try {
        const theme = await db.theme.findUnique({
            where: {
                id,
            },
        })
        if (!theme) {
            return { success: false, message: 'Tema não encontrado' }
        }
        return { success: true, data: theme }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Erro de unicidade' }
        }
        return { success: false, message: 'Erro ao buscar tema' }
    }
}

export async function updateThemeByIdService(id, validatedData) {
    try {
        const updateTheme = await db.theme.update({
            where: {
                id,
            },
            data: validatedData,
        })

        revalidatePath('/adm/theme/read')

        return { success: true, message: 'Tema atualizado com sucesso', data: updateTheme }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Erro de unicidade ao atualizar tema --' + error.meta.target + '--' }
        }
        return { success: false, message: 'Erro ao atualizar tema' }
    }
}

export async function deleteThemeByIdService(id) {
    try {
        await db.theme.delete({
            where: {
                id,
            },
        })

        revalidatePath('/adm/theme/read')

        return { success: true, message: 'Tema deletado com sucesso' }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Erro de unicidade ao deletar tema --' + error.meta.target + '--' }
        }
        return { success: false, message: 'Erro ao deletar tema' }
    }
}
