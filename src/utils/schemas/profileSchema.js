import { z } from 'zod'

export const profileSchema = z.object({
    name: z.string().min(1, { message: 'Nome é obrigatório' }),
    birthDate: z.coerce.date(),
    phone: z.string().min(1, { message: 'Telefone é obrigatório' }).regex(/^\d+$/, { message: 'Telefone deve conter apenas números' }),
    email: z.string().email({ message: 'Email inválido' }),
    address: z.string().min(1, { message: 'Endereço é obrigatório' }),
    username: z.string().min(1, { message: 'Username é obrigatório' }),
    photo: z.string().optional(),
})
