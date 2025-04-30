"use client"
import ButtonBack from '@/app/components/ButtonBack'
import ButtonSubmit from '@/app/components/ButtonSubmit'
import 'bootstrap-icons/font/bootstrap-icons.css'
//import { allThemesToSelectedService } from '@/app/services/themeService'
//import { getUserByRoleTeacherService } from '@/app/services/userService'
import ComponentsList from '@/app/components/ComponentsList';
import { createTccActions } from '@/actions/theme/createTccActions'
import { useRouter } from 'next/navigation'
import { useState } from 'react'
import { toast } from 'react-toastify'

export default function Page() {
    //const { data: themes } = await allThemesToSelectedService()
    //const { data: teachers } = await getUserByRoleTeacherService()
    //const [message, setMessage] = useState("teste")
    const router = useRouter()

    const handleSubmit = async formData => {
        const formDataObj = Object.fromEntries(formData.entries());

        const data = {
            ...formDataObj,
            members: componentes, // <-- insere o array do useState aqui
        };
        const response = await createTccActions(data)
        if (!response.success) {
            console.log('error')
            console.log(data)
            console.log(response.message)
            console.log(componentes)

            //setMessage(response.message)
        } else {
            console.log('sucesso')
            // setMessage(true)

            setTimeout(() => {
                router.push('/student/tcc/read')
            }, 2000)

            toast.success('navegando para tela de proposta...', {
                position: 'bottom-center',
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: false,
                pauseOnHover: false,
                draggable: false,
                progress: undefined,
                theme: 'light',
            })
        }
    }

    const [componentes, setComponentes] = useState(['']);

    const adicionarComponente = () => {
        setComponentes([...componentes, '']);
    };

    const removerComponente = (index) => {
        setComponentes(componentes.filter((_, i) => i !== index));
    };

    const handleChange = (index, value) => {
        const novos = [...componentes];
        novos[index] = value;
        setComponentes(novos);
    };

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
                <form className="row g-2 text-black w-50 my-2" action={handleSubmit}>
                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="advisor" className="form-label m-0 p-0 fs-6">
                            Orientador:
                        </label>
                        <select id="advisor" name="advisor" className="form-select mx-2 form-select-sm">
                            <option value="" defaultValue >Selecione</option>
                            <option value="teste">teste</option>
                            {/*  
                            {teachers.map(teacher => (
                                <option key={teacher.id} value={teacher.id}>
                                    {teacher.name}
                                </option>
                            ))}*/}
                        </select>
                    </div>

                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
                            Tema:
                        </label>
                        <select id="themeId" name="themeId" className="form-select mx-2 form-select-sm">
                            <option value="" defaultValue>Selecione</option>
                            <option value="99b7b71b-4acb-47f6-ad92-f787ec687bc8">teste</option>
                            {/* {themes.map(theme => (
                                <option key={theme.id} value={theme.id}>
                                    {theme.name}
                                </option>
                            ))}*/}
                        </select>
                    </div>

                    <table className="table my-3">
                        <thead>
                            <tr>
                                <th scope="col">Nome dos componentes:</th>
                                <th scope="col">
                                    <i className="bi bi-plus-circle-fill custom-icon-green" style={{ cursor: 'pointer' }} onClick={adicionarComponente}></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {componentes.map((componente, index) => (
                                <tr key={index}>
                                    <td>
                                        <input
                                            type="text"
                                            className="form-control mx-2 form-control-sm w-75"
                                            value={componente}
                                            onChange={(e) => handleChange(index, e.target.value)}
                                        />
                                    </td>
                                    <td>
                                        <i
                                            className="bi bi-x-circle-fill custom-icon-red"
                                            style={{ cursor: 'pointer' }}
                                            onClick={() => removerComponente(index)}
                                        ></i>
                                    </td>
                                </tr>
                            ))}
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
