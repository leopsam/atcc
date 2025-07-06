import { NextResponse } from 'next/server'
import { getUserByRoleTeacherServiceJson } from '@/app/services/userService'
import { getByUserIdInMembers } from '@/app/services/tccService'
import { getTccInfoByUserIdInMembers } from '@/app/actions/tcc/readTccActions'

export async function GET() {
    try {
        const tcc = await getTccInfoByUserIdInMembers()
        return tcc
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
    }
}
