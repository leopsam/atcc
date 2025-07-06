'use client'
import { useRouter } from 'next/navigation'
import { useState } from 'react'
import { toast } from 'react-toastify'
import { createThemeActions } from '@/app/actions/theme/createThemeActions'
import ButtonBack from '@/app/components/ButtonBack'
import ButtonSubmit from '@/app/components/ButtonSubmit'

export default function ThemeCreat() {
    const [message, setMessage] = useState(null)
    const router = useRouter()

    const handleSubmit = async formData => {
        const response = await createThemeActions(formData)
        if (!response.success) {
            setMessage(response.message)
        } else {
            setMessage(true)

            setTimeout(() => {
                router.push('/adm/theme/read')
            }, 2000)

            toast.success('Voltando para tela de temas', {
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
                <h1 className="text-black">Cadastro de tema</h1>
                {message &&
                    (message === true ? (
                        <div className="alert alert-success" role="alert">
                            Tema criado com sucesso!
                        </div>
                    ) : (
                        <div className="alert alert-danger" role="alert">
                            {message}
                        </div>
                    ))}
                <form className="row g-3 text-black w-50" action={handleSubmit}>
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
                        <ButtonSubmit>Cadastrar</ButtonSubmit>
                        <ButtonBack href={'/adm/theme/read'} />
                    </div>
                </form>
            </section>
        </main>
    )
}
