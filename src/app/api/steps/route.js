import { NextResponse } from 'next/server'
import { getTccInfoByUserIdInMembersAction } from '@/server/controllers/tcc/readTccActions'

export async function GET() {
    try {
        const tcc = await getTccInfoByUserIdInMembersAction()
        return tcc
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
    }
}
