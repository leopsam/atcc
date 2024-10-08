'use server';
import bcrypt from 'bcrypt';
import { z } from 'zod';

import { updateUserByIdService } from '@/app/services/userService';
import { userSchema } from '@/utils/schemas/userSchema';

export async function updateUserActions(id, formData) {
    try {
        const formDataObj = {
            matriculation: formData.get('matriculation'),
            name: formData.get('name'),
            role: formData.get('role'),
            status: formData.get('status'),
            birthDate: formData.get('birthDate'),
            cpf: formData.get('cpf'),
            rg: formData.get('rg'),
            phone: formData.get('phone'),
            email: formData.get('email'),
            address: formData.get('address'),
            username: formData.get('username'),
            password: formData.get('password'),
        };

        const validatedData = userSchema.parse(formDataObj);

        const saltRounds = 10;
        const hashedPassword = await bcrypt.hash(validatedData.password, saltRounds);

        validatedData.password = hashedPassword;

        const result = await updateUserByIdService(id, validatedData);
        return result;
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map((err) => `${err.path[0]}: ${err.message}`).join(', ');
            return { success: false, message: `Erro de validação: ${errorMessages}` };
        }

        if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique os dados fornecidos.' };
        } else {
            return { success: false, message: 'Erro inesperado ao editar usuário.' };
        }
    }
}
