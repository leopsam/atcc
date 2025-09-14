'use client'
import { useRouter } from 'next/navigation'
import { toast } from 'react-toastify'
import removeUserActions from '@/server/controllers/user/removeUserActions'

export default function Page({ params }) {
    const router = useRouter()
    async function handleRemove() {
        await removeUserActions(params.id)
        toast.success('Usuário deletado! Voltando para tela de usuários.', {
            position: 'bottom-center',
            autoClose: 3000,
            hideProgressBar: false,
            closeOnClick: false,
            pauseOnHover: false,
            draggable: false,
            progress: undefined,
            theme: 'light',
        })
        router.push('/adm/user/read')
    }
    return (
        <section className="dashboard-adm px-3 mt-3">
            <div className="card m-5">
                <div className="card-header">Deletar Usuário ID: {params.id}</div>
                <div className="card-body">
                    <h5 className="card-title">Você tem certeza de deletar?</h5>
                    <p className="card-text">Se deletar usuário atual, não tera mais volta!</p>
                    <button type="button" className="btn btn-danger m-2" onClick={handleRemove}>
                        Sim
                    </button>
                    <button type="button" className="btn btn-success" onClick={() => router.push('/adm/user/read')}>
                        Não
                    </button>
                </div>
            </div>
        </section>
    )
}
