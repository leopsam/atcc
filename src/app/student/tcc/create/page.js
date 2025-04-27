import ButtonBack from '@/app/components/ButtonBack'
import ButtonSubmit from '@/app/components/ButtonSubmit'
import 'bootstrap-icons/font/bootstrap-icons.css'
import { allThemesService } from '@/app/services/themeService'

export default async function Page() {
    const { data: themes } = await allThemesService()

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
                            {themes.map(theme => (
                                <option key={theme.id} value={theme.id}>
                                    {theme.name}
                                </option>
                            ))}
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
                        <ButtonSubmit>Enviar</ButtonSubmit>
                        <ButtonBack href={'/adm/tcc/read'} />
                    </div>
                </form>
            </div>
        </section>
    )
}
