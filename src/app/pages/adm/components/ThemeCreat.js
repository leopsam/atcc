import styles from "./../../../../styles/adm.module.css";

export default function ThemeCreat() {
  return (
    <main>
      <section className={styles.dashboard}>
        <h1 className="text-black">Cadastro de tema</h1>
        <form className="row g-3 text-black w-50">
          <div className="col-12 d-flex align-items-center">
            <label htmlFor="matricula" className="form-label m-0 p-0 fs-6">
              Tema:
            </label>
            <input type="text" className="form-control mx-2 form-control-sm" id="matricula" placeholder="Nome do tema" />
          </div>

          <div className="col-12">
            <label htmlFor="descricao" className="form-label m-0 p-0 fs-6">
              Descrição:
            </label>
            <textarea className="form-control mx-2 form-control-sm" id="descricao" rows="8" placeholder="Descrição do tema"></textarea>
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
