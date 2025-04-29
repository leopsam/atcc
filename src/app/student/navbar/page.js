import Image from 'next/image'
import Link from 'next/link'
import { getServerSession } from 'next-auth'
import SignoutButtonNavbar from '@/app/components/SignoutButtonNavbar'

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
                        <ul className="navbar-nav me-auto mb-2 mb-md-0 d-flex  ">
                            <li className="nav-item">
                                <Link className="mx-2 custom-link-navbar" href="/student">
                                    Principal
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="mx-2 custom-link-navbar" href="/student/tcc/read">
                                    Proposta
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="mx-2 custom-link-navbar" href="/student/theme/read">
                                    Temas
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="mx-2 custom-link-navbar" href="/student/asd">
                                    Rank
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="mx-2 custom-link-navbar" href="/student/library">
                                    Biblioteca
                                </Link>
                            </li>
                            <li className="nav-item d-block d-md-none">
                                <Link className="mx-2 custom-link-navbar" href="/student/user/settings">
                                    Editar perfil
                                </Link>
                            </li>
                        </ul>
                        <SignoutButtonNavbar />
                    </div>
                </div>
            </nav>
            <nav className="sidebar z-2 position-fixed">
                <div className="text-center d-flex flex-column align-items-center ">
                    <Image src={session?.user?.image} width={500} height={500} alt="Picture of the author" priority />
                    <h1 className="fs-5 my-4 text-white p-2">{session?.user?.name}</h1>
                    <Link className="btn btn-outline-light w-75 rounded-0 my-2" href={`/student/user/settings/${session?.user?.email}`}>
                        Editar perfil
                    </Link>
                    <Link className="btn btn-outline-light w-75 rounded-0 my-2" href="/student/tcc/create">
                        Cadastrar Proposta
                    </Link>
                    <Link className="btn btn-outline-light w-75 rounded-0 my-2" href="/student/steps">
                        Etapas e Cronograma
                    </Link>
                </div>
            </nav>
        </>
    )
}
