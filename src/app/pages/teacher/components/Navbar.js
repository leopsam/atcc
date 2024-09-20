import Image from "next/image";
import perfil from "./../../../../public/prof.jpg";
import style from "./../../../../styles/student.module.css";

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
                <a className="nav-link" href="./student/components/Home">
                  Principal
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link " aria-current="page" href="#">
                  Tcc
                </a>
              </li>
              <li className="nav-item dropdown">
                <a className="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Temas
                </a>
                <ul className="dropdown-menu">
                  <li>
                    <a className="dropdown-item" href="#">
                      Consultar temas
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Temas sugeridos
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Cadastrar temas
                    </a>
                  </li>
                </ul>
              </li>
              <li className="nav-item">
                <a className="nav-link " aria-current="page" href="#">
                  Rank
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link " aria-current="page" href="#">
                  Etapas
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link " aria-current="page" href="#">
                  Biblioteca
                </a>
              </li>

              <li className="nav-item d-block d-md-none">
                <a className="nav-link " aria-current="page" href="#">
                  Editar perfil
                </a>
              </li>
            </ul>
            <button type="button" className="btn p-0  d-block d-md-none">
              Sair
            </button>
          </div>
        </div>
      </nav>
      <div className={style.sidebar}>
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
  );
}
