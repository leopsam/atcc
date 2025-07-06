import { NextResponse } from 'next/server'
import { getToken } from 'next-auth/jwt'

export async function middleware(req) {
    const token = await getToken({ req, secret: process.env.NEXTAUTH_SECRET })
    if (!token) {
        return NextResponse.redirect(new URL('/', req.url))
    }
    const role = token.role

    const { pathname } = req.nextUrl

    if (pathname.startsWith('/dashboard/student') && role !== 'STUDENT') {
        return NextResponse.redirect(new URL('/', req.url))
    }

    if (pathname.startsWith('/dashboard/teacher') && role !== 'TEACHER') {
        return NextResponse.redirect(new URL('/', req.url))
    }
    if (pathname.startsWith('/dashboard/adm') && role !== 'ADMIN') {
        return NextResponse.redirect(new URL('/', req.url))
    }

    return NextResponse.next()
}

export const config = {
    matcher: ['/dashboard/student/:path*', '/dashboard/teacher/:path*', '/dashboard/adm/:path*'],
}
