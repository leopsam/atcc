import ButtonBack from '@/app/components/ButtonBack'
import ButtonSubmit from '@/app/components/ButtonSubmit'
import 'bootstrap-icons/font/bootstrap-icons.css'
import { allThemesToSelectedService } from '@/app/services/themeService'
import { getUserByRoleTeacherService } from '@/app/services/userService'
import ComponentsList from '@/app/components/ComponentsList';

export default async function Page() {
    const { data: themes } = await allThemesToSelectedService()
    const { data: teachers } = await getUserByRoleTeacherService()

    return (
        <section className="dashboard">
            <div className="text-black bg-primary-subtle pt-5 pb-4 px-3">
                <h1 className="fs-2">Insira as informações do seu TCC</h1>
                <p className="fs-6">
                    O cadastro de proposta serve para registrar as informações principais do seu TCC. Nele, você deve informar:<br />
                    <strong>Orientador:</strong> O professor que irá acompanhar e orientar o seu trabalho.<br />
                    <strong>Tema:</strong> O assunto ou área principal que o seu TCC irá defender ou desenvolver.<br />
                    <strong>Componentes:</strong>Os componentes (integrantes) do grupo que participarão do projeto, caso o TCC seja individual, basta cadastrar apenas o seu nome.<br />
                </p>
            </div>

            <div className="px-4 py-2">
                <form className="row g-2 text-black w-50 my-2">
                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
                            Orientador:
                        </label>
                        <select id="situacao" className="form-select mx-2 form-select-sm">
                            <option defaultValue>Selecione</option>
                            {teachers.map(teacher => (
                                <option key={teacher.id} value={teacher.id}>
                                    {teacher.name}
                                </option>
                            ))}
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

                    <ComponentsList />

                    <div className="col-12 d-flex align-items-center py-2">
                        <ButtonSubmit>Enviar</ButtonSubmit>
                        <ButtonBack href={'/adm/tcc/read'} />
                    </div>
                </form>
            </div>
        </section>
    )
}
