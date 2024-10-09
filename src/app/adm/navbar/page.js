import Link from 'next/link'
import Script from 'next/script'
import SignoutButtonAdm from '@/app/components/SignoutButtonAdm'

export default function Navbar() {
    return (
        <>
            <nav className="navbar navbar-expand-lg custom-navbar-bg fixed-top">
                <div className="container-fluid">
                    <a className="navbar-brand text-white" href="#">
                        Administrador
                    </a>
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
                        <SignoutButtonAdm />
                    </div>
                </div>
            </nav>
            <Script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"
            />
        </>
    )
}
