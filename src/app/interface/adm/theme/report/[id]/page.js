import ButtonBack from '@/app/components/ButtonBack'
import { getThemeByIdService } from '@/server/services/themeService'

export default async function getUserById({ params }) {
    const { data: theme } = await getThemeByIdService(params.id)

    return (
        <main>
            <section className="dashboard-adm px-3 mt-3">
                <h1 className="text-black ">Dados do Tema:</h1>
                <div className="card card-width-custom mb-2">
                    <div className="card-body">
                        <h5 className="card-title">{theme.name}</h5>
                    </div>
                    <ul className="list-group list-group-flush">
                        <li className="list-group-item">
                            <strong>Descrição:</strong> {theme.description}
                        </li>
                    </ul>
                </div>
                <ButtonBack href={'/adm/theme/read'} />
            </section>
        </main>
    )
}
