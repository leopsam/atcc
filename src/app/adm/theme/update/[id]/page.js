'use client'
import { useRouter } from 'next/navigation'
import { useState } from 'react'
import { toast } from 'react-toastify'
import { updateThemeActions } from '@/actions/theme/updateThemeActions'
import ButtonBack from '@/app/components/ButtonBack'

export default function Page({ params }) {
    const [message, setMessage] = useState(null)
    const router = useRouter()

    const handleSubmit = async formData => {
        const response = await updateThemeActions(params.id, formData)
        if (!response.success) {
            setMessage(response.message)
        } else {
            setMessage(true)

            setTimeout(() => {
                router.push('/adm/theme/read')
            }, 2000)

            toast.success('Voltando para tela de Temas', {
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
                <h1 className="text-black">Editando Tema: </h1>
                <h2 className="p-1">ID: {params.id}</h2>
                {message &&
                    (message === true ? (
                        <div className="alert alert-success" role="alert">
                            Tema atualizado com sucesso! Voltando Para tela de usuario...
                        </div>
                    ) : (
                        <div className="alert alert-danger" role="alert">
                            {message}
                        </div>
                    ))}
                <form className="row g-2 text-black w-75" action={handleSubmit}>
                    <hr />
                    <div className="col-12 d-flex align-items-center">
                        <label htmlFor="matricula" className="form-label m-0 p-0 fs-6">
                            Tema:
                        </label>
                        <input type="text" className="form-control mx-2 form-control-sm" id="name" name="name" placeholder="Titulo do tema" />
                    </div>

                    <div className="col-12">
                        <label htmlFor="descricao" className="form-label m-0 p-0 fs-6">
                            Descrição:
                        </label>
                        <textarea
                            className="form-control mx-2 form-control-sm"
                            id="description"
                            name="description"
                            rows="8"
                            placeholder="Descrição do tema"
                        ></textarea>
                    </div>

                    <div className="col-12 d-flex align-items-center">
                        <button type="submit" className="btn text-bg-light border border-dark-subtle m-1">
                            Cadastrar
                        </button>
                        <ButtonBack href={'/adm/theme/read'} />
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
            </section>
        </main>
    )
}
