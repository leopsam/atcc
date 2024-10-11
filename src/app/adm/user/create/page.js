'use client'
import { useRouter } from 'next/navigation'
import { useState } from 'react'
import { toast } from 'react-toastify'
import { createUserActions } from '@/actions/user/createUserActions'
import ButtonBack from '@/app/components/ButtonBack'
import InputImageBase64 from '@/app/components/ImageBase64'

export default function Page() {
    const [message, setMessage] = useState(null)
    const [imageBase64, setImageBase64] = useState('')
    const router = useRouter()

    const handleImageChange = base64 => {
        setImageBase64(base64)
    }

    const handleSubmit = async formData => {
        formData.append('photo', imageBase64)
        const response = await createUserActions(formData)
        if (!response.success) {
            setMessage(response.message)
        } else {
            setMessage(true)

            setTimeout(() => {
                router.push('/adm/user/read')
            }, 2000)

            toast.success('Voltando para tela de usuários', {
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

    return (
        <main>
            <section className="dashboard-adm px-3 mt-3">
                <h1 className="text-black">Cadastro de usuário</h1>
                {message &&
                    (message === true ? (
                        <div className="alert alert-success" role="alert">
                            Usuário criado com sucesso!
                        </div>
                    ) : (
                        <div className="alert alert-danger" role="alert">
                            {message}
                        </div>
                    ))}
                <form className="row g-3 text-black w-75" action={handleSubmit}>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="matricula" className="form-label m-0 p-0 fs-6">
                            Matricula:
                        </label>
                        <input
                            type="text"
                            className="form-control mx-2 form-control-sm"
                            id="matriculation"
                            name="matriculation"
                            placeholder="Matricula do usuário"
                        />
                    </div>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="nome" className="form-label m-0 p-0 fs-6">
                            Nome:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="name" name="name" placeholder="Nome completo" />
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="profile" className="form-label m-0 p-0 fs-6">
                            Perfil:
                        </label>
                        <select id="role" name="role" className="form-select mx-2 form-select-sm">
                            <option defaultValue>Selecione</option>
                            <option value="STUDENT">Aluno</option>
                            <option value="TEACHER">Professor</option>
                        </select>
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
                            Situação:
                        </label>
                        <select id="status" name="status" className="form-select mx-2 form-select-sm">
                            <option defaultValue>Selecione</option>
                            <option value="ACTIVE">Ativo</option>
                            <option value="INACTIVE">Inativo</option>
                        </select>
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="nascimento" className="form-label m-0 p-0 fs-6">
                            Nascimento:
                        </label>

                        <input
                            type="date"
                            className="form-control mx-2 form-control-sm input-date placeholder-gray"
                            id="birthDate"
                            name="birthDate"
                            placeholder="dd/mm/aaaa"
                        />
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="cpf" className="form-label m-0 p-0 fs-6">
                            CPF:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="cpf" name="cpf" placeholder="Não insira . / - ," />
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="rg" className="form-label m-0 p-0 fs-6">
                            RG:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="rg" name="rg" placeholder="Não insira . / - ," />
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="tel" className="form-label m-0 p-0 fs-6">
                            Telefone:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="phone" name="phone" placeholder="DDD + numero" />
                    </div>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="email" className="form-label m-0 p-0 fs-6">
                            Email:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="email" name="email" placeholder="Email valido" />
                    </div>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="tel" className="form-label m-0 p-0 fs-6">
                            Endereço:
                        </label>
                        <input
                            type="text"
                            className="form-control mx-2 form-control-sm"
                            id="address"
                            name="address"
                            placeholder="Rua, Avenida, Numero, Bairro, Cidade..."
                        />
                    </div>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="username" className="form-label m-0 p-0 fs-6">
                            Login:
                        </label>
                        <input
                            type="text"
                            className="form-control mx-2 form-control-sm"
                            id="username"
                            name="username"
                            placeholder="Nome de usuario (username)"
                        />
                    </div>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="password" className="form-label m-0 p-0 fs-6">
                            Senha:
                        </label>
                        <input type="password" className="form-control mx-2 form-control-sm" id="password" name="password" placeholder="maximo 8 digitos" />
                    </div>
                    <InputImageBase64 onImageChange={handleImageChange} />
                    <div className="col-12 d-flex align-items-center">
                        <button type="submit" className="btn text-bg-light border border-dark-subtle m-1">
                            Cadastrar
                        </button>
                        <ButtonBack href={'/adm/user/read'} />
                    </div>
                </form>
            </section>
        </main>
    )
}
