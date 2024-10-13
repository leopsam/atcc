import ButtonSubmit from '@/app/components/ButtonSubmit'

export default function ThemeCreat() {
    return (
        <main>
            <section className="dashboard">
                <div className="px-4 py-5">
                    <h1 className="text-black fs-4">Cadastro de tema</h1>
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
                            <ButtonSubmit>Cadastrar</ButtonSubmit>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    )
}
