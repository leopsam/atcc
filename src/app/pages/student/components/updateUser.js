import style from "../../../../styles/student.module.css";

export default function updateUser() {
  return (
    <main>
      <section className={style.dashboard}>
        <div className="p-4">
          <h1 className="text-black fs-4">Edição de perfil</h1>
          <form className="row g-2 text-black w-50 my-2">
            <div className="col-12 d-flex align-items-center">
              <label htmlFor="nome" className="form-label m-0 p-0 fs-6">
                Nome:
              </label>
              <input type="text" className="form-control mx-2 form-control-sm" id="nome" placeholder="Leonardo Sampaio" />
            </div>
            <div className="col-12 d-flex align-items-center">
              <label htmlFor="email" className="form-label m-0 p-0 fs-6">
                Email:
              </label>
              <input type="email" className="form-control mx-2 form-control-sm" id="email" placeholder="leonardo@email.com" />
            </div>
            <div className="col-12 d-flex align-items-center">
              <label htmlFor="login" className="form-label m-0 p-0 fs-6">
                Login:
              </label>
              <input type="text" className="form-control mx-2 form-control-sm" id="login" placeholder="user0001" />
            </div>
            <div className="col-12 d-flex align-items-center">
              <label htmlFor="password" className="form-label m-0 p-0 fs-6">
                Senha:
              </label>
              <input type="password" className="form-control mx-2 form-control-sm" id="password" placeholder="************" />
            </div>

            <div className="col-12 d-flex align-items-center">
              <label htmlFor="formFile" className="form-label m-0 p-0 fs-6">
                Foto:
              </label>
              <input className="form-control mx-2 form-control-sm" type="file" id="formFile" />
            </div>

            <div className="col-12 d-flex align-items-center py-2">
              <button type="submit" className="btn text-bg-light btn-sm border border-dark-subtle m-1">
                Editar
              </button>
              <button type="submit" className="btn text-bg-light btn-sm border border-dark-subtle m-1">
                Voltar
              </button>
            </div>
          </form>
        </div>
      </section>
    </main>
  );
}
