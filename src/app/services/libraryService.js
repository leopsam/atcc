import db from '@/utils/db'

export async function allLibraryService(page, searchTerm, searchType) {
    try {
        const where = {}
        if (searchTerm) {
            where.title = {
                contains: searchTerm,
                mode: 'insensitive',
            }
        }
        if (searchType) {
            where.type = searchType
        }
        const perPage = 25
        const skip = (page - 1) * perPage
        const totalItems = await db.library.count({ where })
        const totalPages = Math.ceil(totalItems / perPage)
        const prev = page > 1 ? page - 1 : null
        const next = page < totalPages ? page + 1 : null

        const library = await db.library.findMany({
            take: perPage,
            skip,
            where,
            orderBy: { createdAt: 'desc' },
        })
        return { data: library, prev, next, totalPages }
    } catch (error) {
        return { data: [], prev: null, next: null }
    }
}
