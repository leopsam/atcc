import { z } from 'zod'

export const tccSchema = z.object({
    advisor: z.string().min(1, { message: 'Nome do orientador é obrigatório' }),
    themeId: z.string().uuid({ message: 'ID do tema inválido' }),
    members: z.array(z.string().min(1, { message: 'Nome do integrante é obrigatório' })).min(1, { message: 'Pelo menos um integrante deve ser informado' }),
})
