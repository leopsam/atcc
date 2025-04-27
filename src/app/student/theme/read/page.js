import { allThemesService } from '@/app/services/themeService'

export default async function Page() {
    const { data: themes } = await allThemesService()

    return (
        <section className="dashboard">
            <div className="px-4 py-5">
                <h1 className="text-black fs-4">Temas</h1>
                <table className="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">Tema</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        {themes.map(theme => (
                            <tr key={theme.id}>
                                <td>{theme.name}</td>
                                <td>{theme.description}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </section>
    )
}
