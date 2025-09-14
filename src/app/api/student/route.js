import { NextResponse } from 'next/server'
import { getUserByRoleStudentServiceJson } from '@/server/services/userService'

export async function GET() {
    try {
        const student = await getUserByRoleStudentServiceJson()
        return student
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
    }
}
