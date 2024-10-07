import 'bootstrap-icons/font/bootstrap-icons.css';

export default function Page() {
    return (
        <section className="dashboard">
            <div className="px-4 py-5">
                <h1 className="text-black fs-4">Insira as informações do seu TCC</h1>
                <form className="row g-2 text-black w-50 my-2">
                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
                            Orientador:
                        </label>
                        <select id="situacao" className="form-select mx-2 form-select-sm">
                            <option defaultValue>Selecione</option>
                            <option>Tema01</option>
                            <option>tema03</option>
                        </select>
                    </div>

                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
                            Tema:
                        </label>
                        <select id="situacao" className="form-select mx-2 form-select-sm">
                            <option defaultValue>Selecione</option>
                            <option>Tema01</option>
                            <option>tema03</option>
                        </select>
                    </div>

                    <table className="table my-3">
                        <thead>
                            <tr>
                                <th scope="col">Nome dos componentes:</th>
                                <th scope="col">
                                    <i className="bi bi-plus-circle-fill custom-icon-green"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" className="form-control mx-2 form-control-sm w-75" id="component" />
                                </td>
                                <td>
                                    <i className="bi bi-x-circle-fill custom-icon-red"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div className="col-12 d-flex align-items-center py-2">
                        <button type="submit" className="btn text-bg-light btn-sm border border-dark-subtle m-1">
                            Salvar
                        </button>
                        <button type="submit" className="btn text-bg-light btn-sm border border-dark-subtle m-1">
                            Voltar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    );
}
