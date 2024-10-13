import { revalidatePath } from 'next/cache'
import db from '@/utils/db'

export async function allLibraryService() {
    try {
        const library = await db.library.findMany()
        return { data: library }
    } catch (error) {
        return { data: [] }
    }
}

/*---------------------------------------------resto------------------------------------------------------*/

export async function createThemeService(validatedData) {
    try {
        await db.theme.create({
            data: validatedData,
        })

        revalidatePath('/adm/theme/read')

        return { success: true, message: 'Tema criado com sucesso' }
    } catch (error) {
        if (error.code === 'P2002') {
            return { success: false, message: 'Tema já existe com este dado único --' + error.meta.target + '--' }
        }
        return { success: false, message: 'Erro ao criar Tema.' }
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
