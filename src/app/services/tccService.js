import db from '@/utils/db'

export async function createTccService(validatedData) {
    try {
        await db.tcc.create({
            data: validatedData,
        })

        return { success: true, message: 'Proposta criado com sucesso' }
    } catch (error) {
        return { success: false, message: 'Erro ao criar Proposta.' }
    }
}

export async function getByUserIdInMembers(userId) {
    try {
        const response = await db.tcc.findFirst({
            where: {
                members: {
                    has: userId,
                },
            },
        })

        return { data: response }
    } catch (error) {
        return { success: false, message: 'Erro ao buscar proposta' }
    }
}

export async function getTccByUserId(userId) {
    try {
        const response = await db.tcc.findFirst({
            where: {
                members: {
                    has: userId,
                },
            },
        })

        if (response === null) {
            return { success: false }
        }

        return { success: true, data: response }
    } catch (error) {
        return { success: false, message: 'Erro ao buscar TCC' }
    }
}
