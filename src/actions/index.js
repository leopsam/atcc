'use server';
import bcrypt from 'bcrypt';
import translate from 'translate';
import { z } from 'zod';

import db from '@/utils/db';
import { userSchema } from '@/utils/schemas/userSchema';
import userDefault from '@/utils/userDefault';

export async function createUser(formData) {
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
            photo: formData.get('photo') ? formData.get('photo') : userDefault,
        };

        const validatedData = userSchema.parse(formDataObj);

        const saltRounds = 10;
        const hashedPassword = await bcrypt.hash(validatedData.password, saltRounds);

        validatedData.password = hashedPassword;

        await db.user.create({
            data: validatedData,
        });

        return { success: true, message: 'Usuário criado com sucesso' };
    } catch (error) {
        if (error instanceof z.ZodError) {
            const errorMessages = error.errors.map((err) => `${err.path[0]}: ${err.message}`).join(', ');
            return { success: false, message: `Erro de validação: ${errorMessages}` };
        }

        if (error.code === 'P2002') {
            const translatedMessage = await translate(error.meta.target, 'pt');
            return { success: false, message: 'Usuário já existe com este dado único => ' + translatedMessage };
        } else if (error instanceof TypeError) {
            return { success: false, message: 'Erro de tipo de dado. Verifique os dados fornecidos.' };
        } else {
            return { success: false, message: 'Erro inesperado ao criar usuário.' };
        }
    }
}
