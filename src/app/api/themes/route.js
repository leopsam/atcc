import { NextResponse } from 'next/server'
import { allThemesToSelectedServiceJson } from '@/app/services/themeService'

export async function GET() {
    try {
        const themes = await allThemesToSelectedServiceJson()
        return themes
    } catch (error) {
        return NextResponse.json({ data: [] }, { status: 500 })
    }
}
