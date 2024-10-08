import { NextResponse } from 'next/server'
import { getToken } from 'next-auth/jwt'

export async function middleware(req) {
    const token = await getToken({ req, secret: process.env.NEXTAUTH_SECRET })

    // Verifica se o usuário está autenticado
    if (!token) {
        // Se não houver token, redireciona para a página de login
        return NextResponse.redirect(new URL('/', req.url))
    }

    // Verifica se o usuário tem a role necessária para acessar a rota
    const role = token.role

    const { pathname } = req.nextUrl

    // Se o usuário tentar acessar a rota /student e não for um estudante, redireciona
    if (pathname.startsWith('/student') && role !== 'STUDENT') {
        return NextResponse.redirect(new URL('/', req.url))
    }

    // Se o usuário tentar acessar a rota /teacher e não for um professor, redireciona
    if (pathname.startsWith('/teacher') && role !== 'TEACHER') {
        return NextResponse.redirect(new URL('/', req.url))
    }

    // Se o usuário tentar acessar a rota /adm e não for um administrador, redireciona
    if (pathname.startsWith('/adm') && role !== 'ADMIN') {
        return NextResponse.redirect(new URL('/', req.url))
    }

    // Se o usuário passar nas verificações, permite o acesso à rota
    return NextResponse.next()
}

// Configura para aplicar o middleware apenas para essas rotas
export const config = {
    matcher: ['/student/:path*', '/teacher/:path*', '/adm/:path*'],
}
