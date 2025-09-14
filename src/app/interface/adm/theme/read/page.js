import ButtonsTable from '@/app/components/ButtonsTable'
import { allThemesService } from '@/server/services/themeService'

export default async function Page() {
    const { data: themes } = await allThemesService()

    return (
        <main>
            <section className="dashboard-adm px-3 mt-3">
                <h1 className="text-black">Temas</h1>
                <table className="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descrição</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {themes.map(theme => (
                            <tr key={theme.id}>
                                <td>{theme.name}</td>
                                <td>{theme.description}</td>
                                <td>
                                    <ButtonsTable href={`/adm/theme/update/${theme.id}`}>Editar</ButtonsTable>
                                    <ButtonsTable href={`/adm/theme/report/${theme.id}`}>Relatório</ButtonsTable>
                                    <ButtonsTable href={`/adm/theme/remove/${theme.id}`}>Deletar</ButtonsTable>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </section>
        </main>
    )
}
