import { z } from 'zod'

export const themeSchema = z.object({
    name: z.string().min(1, { message: 'Titulo é obrigatório' }),
    description: z.string().min(1, { message: 'descrição é obrigatório' }),
})
