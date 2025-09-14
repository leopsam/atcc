import { NextResponse } from 'next/server'
import { getUserByRoleTeacherServiceJson } from '@/server/services/userService'

export async function GET() {
    try {
        const teacher = await getUserByRoleTeacherServiceJson()
        return teacher
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
    }
}
