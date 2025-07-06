'use client'
import { signOut } from 'next-auth/react'
import { useState } from 'react'
import { toast } from 'react-toastify'
import { settingsUserActions } from '@/appcontrollers/user/settingsUserActions'
import ButtonBack from '@/app/components/ButtonBack'
import ButtonSubmit from '@/app/components/ButtonSubmit'
import ChangePassword from '@/app/components/ChangePassword'
import InputImageBase64 from '@/app/components/ImageBase64'

export default function Page({ params }) {
    const [message, setMessage] = useState(null)
    const [imageBase64, setImageBase64] = useState('')

    const handleImageChange = base64 => {
        setImageBase64(base64)
    }

    const handleSubmit = async formData => {
        if (!imageBase64 === false) {
            formData.append('photo', imageBase64)
        }

        const response = await settingsUserActions(params.email, formData)
        if (!response.success) {
            setMessage(response.message)
        } else {
            setMessage(true)

            setTimeout(() => {
                signOut()
            }, 2000)

            toast.success('Atualizado com sucesso! Deslogando para aplicar as alterações...', {
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
        <section className="dashboard">
            <div className="p-4">
                <h1 className="text-black fs-4">Edição de perfil</h1>
                {message &&
                    (message === true ? (
                        <div className="alert alert-success" role="alert">
                            Atualizado com sucesso! Voltando...
                        </div>
                    ) : (
                        <div className="alert alert-danger" role="alert">
                            {message}
                        </div>
                    ))}
                <form className="row g-2 text-black my-2" autoComplete="off" action={handleSubmit}>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="nome" className="form-label m-0 p-0 fs-6">
                            Nome:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="name" name="name" placeholder="Leonardo Sampaio" />
                    </div>
                    <div className="col-md-4 d-flex align-items-center">
                        <label htmlFor="email" className="form-label m-0 p-0 fs-6">
                            Email:
                        </label>
                        <input type="email" className="form-control mx-2 form-control-sm" id="email" name="email" placeholder="leonardo@email.com" />
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
                    <div className="col-12 d-flex align-items-center">
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
                        <label htmlFor="tel" className="form-label m-0 p-0 fs-6">
                            Telefone:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="phone" name="phone" placeholder="DDD + numero" />
                    </div>
                    <div className="col-md-6 d-flex align-items-center">
                        <label htmlFor="login" className="form-label m-0 p-0 fs-6">
                            Login:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="username" name="username" placeholder="user0001" />
                    </div>

                    <InputImageBase64 onImageChange={handleImageChange} />
                    <ChangePassword />
                    <div className="col-12 d-flex align-items-center py-2">
                        <ButtonSubmit>Salvar</ButtonSubmit>
                        <ButtonBack href={'/student'} />
                    </div>
                </form>
                <div className="card m-5">
                    <div className="card-header">AVISO</div>
                    <div className="card-body">
                        <p className="card-text m-0">
                            No processo de atualização dos dados do usuário, é possível modificar qualquer campo disponível no formulário.
                        </p>
                        <p className="card-text m-0">
                            Caso algum campo não seja preenchido, o valor correspondente ao atributo não será alterado, mantendo-se o valor atual registrado no
                            sistema.
                        </p>
                        <p className="card-text m-0">Isso garante que os campos não modificados durante a operação de atualização permaneçam inalterados.</p>
                    </div>
                </div>
            </div>
        </section>
    )
}
