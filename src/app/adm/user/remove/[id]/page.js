'use client';
import { useRouter } from 'next/navigation';

import removeUserActions from '@/actions/removeUserActions';

export default function Page({ params }) {
    const router = useRouter();
    async function handleRemove() {
        await removeUserActions(params.id);
        router.push('/adm/user/read');
    }
    return (
        <div class="card m-5">
            <div class="card-header">Deletar Usuario</div>
            <div class="card-body">
                <h5 class="card-title">você tem certeza de deletar?</h5>
                <p class="card-text">Se deletar usuario atual, não tera mais volta!</p>
                <button type="button" class="btn btn-danger m-2" onClick={handleRemove}>
                    Sim
                </button>
                <button type="button" class="btn btn-success" onClick={() => router.push('/adm/user/read')}>
                    Não
                </button>
            </div>
        </div>
    );
}
