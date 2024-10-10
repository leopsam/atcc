import Image from 'next/image'
import Link from 'next/link'
import { getServerSession } from 'next-auth'
import SignoutButtonUsers from '@/app/components/SignoutButtonUsers'

export default async function Page() {
    const session = await getServerSession()

    return (
        <>
            <nav className="navbar navbar-expand-md custom-navbar-bg z-3 fixed-top">
                <div className="container-fluid">
                    <div className="custom-link-text-logo ms-1 me-3">
                        <h1 className="m-0 p-0 fs-3">A.T.C.C</h1>
                    </div>
                    <button
                        className="navbar-toggler custom-button-hamburguer-user custom-button-hamburguer-size-color p-0 border-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span className="bi bi-list"></span>
                    </button>
                    <div className="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul className="navbar-nav me-auto mb-2 mb-md-0">
                            <li className="nav-item">
                                <Link className="nav-link" href="/student">
                                    Principal
                                </Link>
                            </li>
                            <li className="nav-item dropdown">
                                <Link className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tcc
                                </Link>
                                <ul className="dropdown-menu">
                                    <li>
                                        <Link className="dropdown-item" href="/student/tcc/create">
                                            Cadastrar
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="/student/tcc/read">
                                            Consultar
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                            <li className="nav-item dropdown">
                                <Link className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Temas
                                </Link>

                                <ul className="dropdown-menu">
                                    <li>
                                        <Link className="dropdown-item" href="/student/theme/read">
                                            Consultar temas
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="/student/theme/suggestion/create">
                                            Enviar sugestão
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="/student/theme/suggestion/read">
                                            Suas sugestôes
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" href="/student/asd">
                                    Rank
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" href="/student/steps">
                                    Etapas
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" href="/student/library">
                                    Biblioteca
                                </Link>
                            </li>
                            <li className="nav-item d-block d-md-none">
                                <Link className="nav-link" href="/student/user/settings">
                                    Editar perfil
                                </Link>
                            </li>
                        </ul>
                        <button type="button" className="btn p-0  d-block d-md-none">
                            Sair
                        </button>
                    </div>
                </div>
            </nav>
            <nav className="sidebar z-2 position-fixed">
                <div className="text-center d-flex flex-column align-items-center ">
                    <Image src={session?.user?.image} width={200} height={200} alt="Picture of the author" />
                    <h1 className="fs-5 my-4 text-white p-2">{session?.user?.name}</h1>
                    <Link className="btn btn-secondary w-100 rounded-0 my-2 text-white" href={`/student/user/settings/${session?.user?.email}`}>
                        Editar perfil
                    </Link>
                    <SignoutButtonUsers />
                </div>
            </nav>
        </>
    )
}
