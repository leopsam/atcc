import bcrypt from 'bcrypt'
import NextAuth from 'next-auth/next'
import CredentialsProvider from 'next-auth/providers/credentials'
import db from '@/utils/db'
import { cookies } from 'next/headers'

const handler = NextAuth({
    pages: {
        signIn: '/',
    },
    providers: [
        CredentialsProvider({
            name: 'Credentials',
            credentials: {
                email: { label: 'Username', type: 'text', id: 'username' },
                password: { label: 'Password', type: 'password', id: 'password' },
            },
            async authorize(credentials) {
                if (!credentials) throw new Error('Credenciais não fornecidas')

                const user = await db.user.findUnique({
                    where: {
                        username: credentials.username,
                    },
                })

                if (!user) throw new Error('Usuário e senha inválidos')

                const isValidPassword = await bcrypt.compare(credentials.password, user.password)

                if (!isValidPassword) {
                    throw new Error('Usuário e senha inválidos')
                }

                cookies().set('user_id', user.id, {
                    path: '/',
                    maxAge: 60 * 60 * 24 * 7, // 7 dias
                    httpOnly: false, // ⚠️ IMPORTANTE! Para poder ler no front-end
                })

                return {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    role: user.role,
                    image: user.photo,
                }
            },
        }),
    ],
    callbacks: {
        async session({ session, token }) {
            if (token?.id) {
                session.user.id = token.id
            }
            if (token?.matriculation) {
                session.user.matriculation = token.matriculation
            }

            if (token?.role) {
                session.user.role = token.role
            }
            return session
        },
        async jwt({ token, user }) {
            if (user) {
                token.id = user.id
                token.matriculation = user.matriculation
                token.role = user.role
            }
            return token
        },
    },

    secret: process.env.NEXTAUTH_SECRET,
})

export { handler as GET, handler as POST }
