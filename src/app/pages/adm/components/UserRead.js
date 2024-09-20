import styles from "./../../../../styles/adm.module.css";

export default function UserRead() {
  return (
    <main>
      <section className={styles.dashboard}>
        <h1 className="text-black">Usuários</h1>
        <table className="table table-striped">
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
                <input type="text" id="txtColuna1" className="form-control form-control-sm" />
              </th>
              <th>
                <input type="text" id="txtColuna2" className="form-control form-control-sm" />
              </th>
              <th>
                <input type="text" id="txtColuna3" className="form-control form-control-sm" />
              </th>
              <th>
                <input type="text" id="txtColuna4" className="form-control form-control-sm" />
              </th>
              <th>
                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
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
                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                  Editar
                </button>
              </td>
              <td>
                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
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
                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                  Editar
                </button>
              </td>
              <td>
                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
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
                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                  Editar
                </button>
              </td>
              <td>
                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
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
