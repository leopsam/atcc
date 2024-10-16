import Link from 'next/link'
import SignoutButtonNavbar from '@/app/components/SignoutButtonNavbar'

export default function Navbar() {
    return (
        <>
            <nav className="navbar navbar-expand-lg custom-navbar-bg fixed-top">
                <div className="container-fluid">
                    <Link className="navbar-brand text-white" href="/adm">
                        Administrador
                    </Link>
                    <button
                        className="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            <li className="nav-item dropdown">
                                <Link className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Usuarios
                                </Link>
                                <ul className="dropdown-menu">
                                    <li>
                                        <Link className="dropdown-item" href="/adm/user/create">
                                            Cadastrar
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="/adm/user/read">
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
                                        <Link className="dropdown-item" href="/adm/theme/create">
                                            Cadastrar
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="/adm/theme/read">
                                            Consultar
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <SignoutButtonNavbar />
                    </div>
                </div>
            </nav>
        </>
    )
}
