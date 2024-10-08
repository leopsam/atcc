export default function Page() {
    return (
        <section className="dashboard">
            <div className="px-4 py-5">
                <h1 className="text-black fs-4">Envio de sugestões de tema</h1>
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
                        <textarea className="form-control mx-2 form-control-sm" id="descricao" rows="5" placeholder="Descrição do tema"></textarea>
                    </div>

                    <div className="col-12 d-flex align-items-center">
                        <button type="submit" className="btn text-bg-light border border-dark-subtle m-1">
                            Enviar
                        </button>
                    </div>
                </form>
                <div className="card my-4">
                    <div className="card-header">AVISO</div>
                    <div className="card-body">
                        <p className="card-text m-0">Na sugestão de tema você enviara um tema com sua descrição.</p>
                        <p className="card-text m-0">Aguarde a aprovação de seu tema sugerido.</p>
                    </div>
                </div>
            </div>
        </section>
    )
}
