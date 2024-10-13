import Image from 'next/image'
import perfil from './../../../../public/prof.jpg'

export default function Navbar() {
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
                                <Link className="nav-link" href="./student/components/Home">
                                    Principal
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link " aria-current="page" href="#">
                                    Tcc
                                </Link>
                            </li>
                            <li className="nav-item dropdown">
                                <Link className="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Temas
                                </Link>
                                <ul className="dropdown-menu">
                                    <li>
                                        <Link className="dropdown-item" href="#">
                                            Consultar temas
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="#">
                                            Temas sugeridos
                                        </Link>
                                    </li>
                                    <li>
                                        <Link className="dropdown-item" href="#">
                                            Cadastrar temas
                                        </Link>
                                    </li>
                                </ul >
                            </li >
                            <li className="nav-item">
                                <Link className="nav-link " aria-current="page" href="#">
                                    Rank
                                </Link>
                            </li >
                            <li className="nav-item">
                                <Link className="nav-link " aria-current="page" href="#">
                                    Etapas
                                </Link>
                            </li >
                            <li className="nav-item">
                                <Link className="nav-link " aria-current="page" href="#">
                                    Biblioteca
                                </Link>
                            </li >

                            <li className="nav-item d-block d-md-none">
                                <Link className="nav-link " aria-current="page" href="#">
                                    Editar perfil
                                </Link>
                            </li >
                        </ul >
                        <button type="button" className="btn p-0  d-block d-md-none">
                            Sair
                        </button>
                    </div >
                </div >
            </nav >
            <div className="sidebar">
                <div className="text-center d-flex flex-column align-items-center">
                    <Image src={perfil} alt="..." />
                    <h1 className="fs-5 my-4">Leonardo Sampaio</h1>
                    <button className="btn btn-secondary w-100 rounded-0 my-2 text-white">Editar perfil</button>
                    <button className="btn btn-secondary w-100 rounded-0 my-2 text-white">Sair</button>
                    <p className="my-4 mx-1">
                        Você está logado como <strong>Professor</strong>.
                    </p>
                </div>
            </div>
        </>
    )
}
