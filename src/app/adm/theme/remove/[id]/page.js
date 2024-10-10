'use client'
import { useRouter } from 'next/navigation'
import { toast } from 'react-toastify'
import removeThemeActions from '@/actions/theme/removeThemeActions'

export default function Page({ params }) {
    const router = useRouter()
    async function handleRemove() {
        await removeThemeActions(params.id)
        toast.success('Tema deletado! Voltando para tela de Temas.', {
            position: 'bottom-center',
            autoClose: 3000,
            hideProgressBar: false,
            closeOnClick: false,
            pauseOnHover: false,
            draggable: false,
            progress: undefined,
            theme: 'light',
        })
        router.push('/adm/theme/read')
    }
    return (
        <section className="dashboard-adm px-3 mt-3">
            <div className="card m-5">
                <div className="card-header">Deletar Tema ID: {params.id}</div>
                <div className="card-body">
                    <h5 className="card-title">Você tem certeza de deletar?</h5>
                    <p className="card-text">Se deletar tema atual, não tera mais volta!</p>
                    <button type="button" className="btn btn-danger m-2" onClick={handleRemove}>
                        Sim
                    </button>
                    <button type="button" className="btn btn-success" onClick={() => router.push('/adm/theme/read')}>
                        Não
                    </button>
                </div>
            </div>
        </section>
    )
}
