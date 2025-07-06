import db from '@/utils/db'

export async function allStepsService() {
    try {
        const steps = await db.step.findMany()
        if (!steps || steps.length === 0) {
            return { data: [], error: 'Nenhuma etapa encontrada.' }
        }
        return { data: steps }
    } catch (error) {
        return { data: [], error: 'Erro ao buscar as etapas.', message: error.message }
    }
}
