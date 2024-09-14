import styles from "./menu.module.css";

export default function Home() {
  return (
    <main>
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
      <section className={styles.dashboard}>
        <h1 className="text-black">Usuarios</h1>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Matricula</th>
              <th scope="col">Nome</th>
              <th scope="col">Perfil</th>
              <th scope="col">Situação</th>
              <th scope="col">CPF</th>
            </tr>
            <tr>
              <th>
                <input type="text" id="txtColuna1" />
              </th>
              <th>
                <input type="text" id="txtColuna2" />
              </th>
              <th>
                <input type="text" id="txtColuna3" />
              </th>
              <th>
                <input type="text" id="txtColuna4" />
              </th>
              <th>
                <input type="text" id="txtColuna5" />
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1713100653</td>
              <td>Leonardo</td>
              <td>Aluno</td>
              <td>Ativo</td>
              <td>16788537823</td>
              <td>
                <button type="button" class="btn btn-secondary btn-sm mx-1">
                  Editar
                </button>

                <button type="button" class="btn btn-secondary btn-sm mx-1">
                  Relatorio
                </button>
              </td>
            </tr>
            <tr>
              <td>1713100653</td>
              <td>Leonardo</td>
              <td>Aluno</td>
              <td>Ativo</td>
              <td>16788537823</td>
              <td>
                <button type="button" class="btn btn-secondary btn-sm mx-1">
                  Editar
                </button>

                <button type="button" class="btn btn-secondary btn-sm mx-1">
                  Relatorio
                </button>
              </td>
            </tr>
            <tr>
              <td>1713100653</td>
              <td>Leonardo</td>
              <td>Aluno</td>
              <td>Ativo</td>
              <td>16788537823</td>
              <td>
                <button type="button" class="btn btn-secondary btn-sm mx-1">
                  Editar
                </button>

                <button type="button" class="btn btn-secondary btn-sm mx-1">
                  Relatorio
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  );
}
