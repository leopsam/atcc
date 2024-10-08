export default function ThemeReadAll() {
    return (
        <main>
            <section className="dashboard">
                <div className="px-4 py-5">
                    <h1 className="text-black fs-4">Temas sugeridos pelos alunos</h1>
                    <table className="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Aluno</th>
                                <th scope="col">Tema</th>
                                <th scope="col">Descrição do tema</th>
                                <th scope="col">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Leonardo Sampaio</td>
                                <td>Sistemas E.R.P.</td>
                                <td>
                                    Nas ultimas duas decadas os sistemas ERP surgiram com a proposta de integrar dados e otimizar processos. Durante essa
                                    jornada, muitos sistemas foram propostos e implementados. Agora precisamos compor um trabalho que apresente as licoes
                                    aprendidas, os erros, as melhores praticas e os dados estatisticos que possam nos orientar para os proximos vinte anos. Esse
                                    trabalho consiste em pesquisa exploratoria junto a empresas de software, seus clientes e mercado atendido (Pequenas, medias
                                    e grandes empresas).
                                </td>
                                <td>Aceito</td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm text-white">
                                        Aceitar
                                    </button>
                                </td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm text-white">
                                        Rejeitar
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Marieni Cristina</td>
                                <td>Sistemas E.R.P.</td>
                                <td>
                                    Nas ultimas duas decadas os sistemas ERP surgiram com a proposta de integrar dados e otimizar processos. Durante essa
                                    jornada, muitos sistemas foram propostos e implementados. Agora precisamos compor um trabalho que apresente as licoes
                                    aprendidas, os erros, as melhores praticas e os dados estatisticos que possam nos orientar para os proximos vinte anos. Esse
                                    trabalho consiste em pesquisa exploratoria junto a empresas de software, seus clientes e mercado atendido (Pequenas, medias
                                    e grandes empresas).
                                </td>
                                <td>Rejeitado</td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm text-white">
                                        Aceitar
                                    </button>
                                </td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm text-white">
                                        Rejeitar
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Marieni Cristina</td>
                                <td>Sistemas E.R.P.</td>
                                <td>
                                    Nas ultimas duas decadas os sistemas ERP surgiram com a proposta de integrar dados e otimizar processos. Durante essa
                                    jornada, muitos sistemas foram propostos e implementados. Agora precisamos compor um trabalho que apresente as licoes
                                    aprendidas, os erros, as melhores praticas e os dados estatisticos que possam nos orientar para os proximos vinte anos. Esse
                                    trabalho consiste em pesquisa exploratoria junto a empresas de software, seus clientes e mercado atendido (Pequenas, medias
                                    e grandes empresas).
                                </td>
                                <td>Aceito</td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm text-white">
                                        Aceitar
                                    </button>
                                </td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm text-white">
                                        Rejeitar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    )
}
