import styles from "./../../../../styles/adm.module.css";

export default function UserCreat() {
  return (
    <main>
      <section className={styles.dashboard}>
        <h1 className="text-black">Cadastro de usuário</h1>
        <form className="row g-3 text-black w-75">
          <div className="col-md-6 d-flex align-items-center">
            <label htmlFor="matricula" className="form-label m-0 p-0 fs-6">
              Matricula:
            </label>
            <input type="text" className="form-control mx-2 form-control-sm" id="matricula" placeholder="Matricula do usuário" />
          </div>
          <div className="col-md-6 d-flex align-items-center">
            <label htmlFor="nome" className="form-label m-0 p-0 fs-6">
              Nome:
            </label>
            <input type="text" className="form-control mx-2 form-control-sm" id="nome" placeholder="Nome completo" />
          </div>

          <div className="col-md-4 d-flex align-items-center">
            <label htmlFor="perfil" className="form-label m-0 p-0 fs-6">
              Perfil:
            </label>
            <select id="perfil" className="form-select mx-2 form-select-sm">
              <option defaultValue>Selecione</option>
              <option>Aluno</option>
              <option>Professor</option>
            </select>
          </div>
          <div className="col-md-4 d-flex align-items-center">
            <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
              Situação:
            </label>
            <select id="situacao" className="form-select mx-2 form-select-sm">
              <option defaultValue>Selecione</option>
              <option>Ativo</option>
              <option>Inativo</option>
            </select>
          </div>
          <div className="col-md-4 d-flex align-items-center">
            <label htmlFor="nascimento" className="form-label m-0 p-0 fs-6">
              Nascimento:
            </label>
            <input type="data12" className="form-control mx-2 form-control-sm" id="nascimento" placeholder="dd/mm/aaaa" />
          </div>

          <div className="col-md-4 d-flex align-items-center">
            <label htmlFor="cpf" className="form-label m-0 p-0 fs-6">
              CPF:
            </label>
            <input type="text" className="form-control mx-2 form-control-sm" id="cpf" placeholder="Não insira . / - ," />
          </div>
          <div className="col-md-4 d-flex align-items-center">
            <label htmlFor="rg" className="form-label m-0 p-0 fs-6">
              RG:
            </label>
            <input type="text" className="form-control mx-2 form-control-sm" id="rg" placeholder="Não insira . / - ," />
          </div>
          <div className="col-md-4 d-flex align-items-center">
            <label htmlFor="tel" className="form-label m-0 p-0 fs-6">
              Telefone:
            </label>
            <input type="tel" className="form-control mx-2 form-control-sm" id="tel" placeholder="DDD + numero" />
          </div>

          <div className="col-md-6 d-flex align-items-center">
            <label htmlFor="email" className="form-label m-0 p-0 fs-6">
              Email:
            </label>
            <input type="email" className="form-control mx-2 form-control-sm" id="email" placeholder="Email valido" />
          </div>
          <div className="col-md-6 d-flex align-items-center">
            <label htmlFor="tel" className="form-label m-0 p-0 fs-6">
              Endereço:
            </label>
            <input type="tel" className="form-control mx-2 form-control-sm" id="tel" placeholder="Rua, Avenida, Numero, Bairro, Cidade..." />
          </div>

          <div className="col-md-6 d-flex align-items-center">
            <label htmlFor="login" className="form-label m-0 p-0 fs-6">
              Login:
            </label>
            <input type="text" className="form-control mx-2 form-control-sm" id="login" placeholder="Login" />
          </div>
          <div className="col-md-6 d-flex align-items-center">
            <label htmlFor="password" className="form-label m-0 p-0 fs-6">
              Senha:
            </label>
            <input type="password" className="form-control mx-2 form-control-sm" id="password" placeholder="maximo 8 digitos" />
          </div>

          <div className="col-12 d-flex align-items-center">
            <label htmlFor="formFile" className="form-label m-0 p-0 fs-6">
              Foto:
            </label>
            <input className="form-control mx-2 form-control-sm" type="file" id="formFile" />
          </div>

          <div className="col-12 d-flex align-items-center">
            <button type="submit" className="btn text-bg-light border border-dark-subtle m-1">
              Cadastrar
            </button>
            <button type="submit" className="btn text-bg-light border border-dark-subtle m-1">
              Voltar
            </button>
          </div>
        </form>
      </section>
    </main>
  );
}
