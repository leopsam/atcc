import Link from 'next/link'
import { allThemesService } from '@/server/services/themeService'

export default async function Page({ searchParams }) {
    const currentPage = parseInt(searchParams?.page || 1)
    const searchTerm = searchParams?.q
    const searchType = searchParams?.t
    const { data: themes, prev, next, totalPages } = await allThemesService(currentPage, searchTerm, searchType)

    return (
        <section className="dashboard">
            <div className="px-4 pt-5 ">
                <h1 className="text-black fs-4">Temas</h1>

                <table className="table table-striped whi">
                    <thead>
                        <tr>
                            <th scope="col">Tema</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        {themes &&
                            themes.map(theme => (
                                <tr key={theme.id} className="align-middle" style={{ height: '75px' }}>
                                    <td>{theme.name}</td>
                                    <td>{theme.description}</td>
                                </tr>
                            ))}
                    </tbody>
                </table>

                <nav aria-label="Page navigation example position-absolute bottom-0 start-50 translate-middle-x">
                    <ul className="pagination pagination-sm justify-content-center">
                        <li className={`page-item ${!prev && 'disabled'}`}>
                            <Link className="page-link" href={{ pathname: '/interface/student/theme/read/', query: { page: prev, q: searchTerm } }}>
                                Anterior
                            </Link>
                        </li>
                        {/* Renderizando dinamicamente os números de páginas */}
                        {[...Array(totalPages)].map((_, index) => {
                            const pageNumber = index + 1
                            return (
                                <li key={pageNumber} className={`page-item ${currentPage === pageNumber ? 'active' : ''}`}>
                                    <Link
                                        className="page-link"
                                        href={{ pathname: '/interface/student/theme/read/', query: { page: pageNumber, q: searchTerm, t: searchType } }}
                                    >
                                        {pageNumber}
                                    </Link>
                                </li>
                            )
                        })}

                        <li className={`page-item ${!next && 'disabled'}`}>
                            <Link className="page-link" href={{ pathname: '/interface/student/theme/read/', query: { page: next, q: searchTerm } }}>
                                Próximo
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    )
}
