import { NextResponse } from 'next/server'
import { getTccInfoByUserIdInMembersAction } from '@/server/controllers/tcc/readTccActions'

export async function GET() {
    try {
        const tcc = await getTccInfoByUserIdInMembersAction()
        return NextResponse.json(tcc)
    } catch (error) {
        return NextResponse.json({ data: [], success: false, message: 'Erro ao buscar etapas.' }, { status: 500 })
    }
}
