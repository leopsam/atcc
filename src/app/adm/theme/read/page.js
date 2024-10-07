import styles from './../../../../styles/adm.module.css';

export default function UserRead() {
    return (
        <main>
            <section className={styles.dashboard}>
                <h1 className="text-black">Temas</h1>
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Identificação</th>
                            <th scope="col">Tema</th>
                            <th scope="col">Descrição</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="text" id="txtColuna3" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna4" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>16788537823</td>
                            <td>Sistemas E.R.P.</td>
                            <td>
                                Nas ultimas duas decadas os sistemas ERP surgiram com a proposta de integrar dados e otimizar processos. Durante essa jornada,
                                muitos sistemas foram propostos e implementados. Agora precisamos compor um trabalho que apresente as licoes aprendidas, os
                                erros, as melhores praticas e os dados estatisticos que possam nos orientar para os proximos vinte anos. Esse trabalho consiste
                                em pesquisa exploratoria junto a empresas de software, seus clientes e mercado atendido (Pequenas, medias e grandes empresas).
                            </td>
                            <td>
                                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                    Relatorio
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>16788537823</td>
                            <td>Smart Cities</td>
                            <td>
                                Gastar menos e oferecer melhores servicos: esse eh o objetivo das cidades do futuro. Como conseguir isso? Implementando hardware
                                e softwares de baixo nivel, propondo novas arquiteturas de servico, manipulando grandes bases de dados e integrando solucoes
                                tecnologicas a outras areas de conhecimento.
                            </td>

                            <td>
                                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                    Relatorio
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>1713100653</td>
                            <td>Bancos de Dados Publicos (big data e open data)</td>
                            <td>
                                Trabalhar com bancos de dados oferece a oportunidade de propor solucoes inovadoras como analisar e recuperar informacao de
                                enormes bases de dados (big data) ou prever comportamento de usuarios e sistemas (predective analytic). Atualmente as bases de
                                dados publicas possuem informacoes demais e poucas ferramentas para isso.
                            </td>

                            <td>
                                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                    Relatorio
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    );
}
