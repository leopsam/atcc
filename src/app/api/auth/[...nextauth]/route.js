import bcrypt from 'bcrypt'
import NextAuth from 'next-auth/next'
import CredentialsProvider from 'next-auth/providers/credentials'
import db from '@/utils/db'

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
            // Adiciona a matrícula à sessão, se estiver no token
            if (token?.matriculation) {
                session.user.matriculation = token.matriculation
            }
            // Adiciona o role à sessão, se estiver no token
            if (token?.role) {
                session.user.role = token.role
            }
            return session
        },
        async jwt({ token, user }) {
            // Quando o usuário faz login, adiciona a matrícula e o role ao token
            if (user) {
                token.matriculation = user.matriculation // Passa a matrícula para o token
                token.role = user.role // Passa o role para o token
            }
            return token
        },
    },

    secret: process.env.NEXTAUTH_SECRET,
})

export { handler as GET, handler as POST }
