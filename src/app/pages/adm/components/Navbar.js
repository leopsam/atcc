export default function Navbar() {
  return (
    <nav className="navbar navbar-expand-lg custom-navbar-bg">
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
              <a
                className="nav-link dropdown-toggle custom-text"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Usuarios
              </a>
              <ul className="dropdown-menu">
                <li>
                  <a className="dropdown-item" href="#">
                    Cadastrar
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Consultar
                  </a>
                </li>
              </ul>
            </li>
            <li className="nav-item dropdown">
              <a
                className="nav-link dropdown-toggle custom-text"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Temas
              </a>
              <ul className="dropdown-menu">
                <li>
                  <a className="dropdown-item" href="#">
                    Cadastrar
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Consultar
                  </a>
                </li>
              </ul>
            </li>
            <li className="nav-item dropdown">
              <a
                className="nav-link dropdown-toggle custom-text"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Tcc
              </a>
              <ul className="dropdown-menu">
                <li>
                  <a className="dropdown-item" href="#">
                    Consultar
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <button type="button" className="btn p-0 custom-text">
            Sair
          </button>
        </div>
      </div>
    </nav>
  );
}
