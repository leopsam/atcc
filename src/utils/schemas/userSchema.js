import { z } from 'zod'

export const userSchema = z.object({
    matriculation: z.string().min(1, { message: 'Matrícula é obrigatória' }),
    name: z.string().min(1, { message: 'Nome é obrigatório' }),
    role: z.enum(['STUDENT', 'TEACHER'], { message: 'Perfil esperado - ALUNO | PROFESSOR' }),
    status: z.enum(['ACTIVE', 'INACTIVE'], { message: 'Situação esperada - ATIVO | INATIVO' }),
    birthDate: z.coerce.date(),
    cpf: z.string().length(11, { message: 'CPF deve ter 11 dígitos' }).regex(/^\d+$/, { message: 'CPF deve conter apenas números' }),
    rg: z.string().min(1, { message: 'RG é obrigatório' }).regex(/^\d+$/, { message: 'RG deve conter apenas números' }),
    phone: z.string().min(1, { message: 'Telefone é obrigatório' }).regex(/^\d+$/, { message: 'Telefone deve conter apenas números' }),
    email: z.string().email({ message: 'Email inválido' }),
    address: z.string().min(1, { message: 'Endereço é obrigatório' }),
    username: z.string().min(1, { message: 'Username é obrigatório' }),
    password: z.string().min(8, { message: 'Senha deve ter pelo menos 8 caracteres' }),
    photo: z.string().optional(),
})
