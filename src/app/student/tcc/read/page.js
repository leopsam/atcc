import 'bootstrap-icons/font/bootstrap-icons.css'

export default function Page() {
    return (
        <section className="dashboard">
            <div className="px-4 py-5">
                <h1 className="text-black fs-4">Imformações TCC</h1>
                <div className="card">
                    <div className="card-body text-bg-secondary">
                        <h5 className="card-title">Smart Cities</h5>
                        <p className="card-text">
                            <strong>Descrição do tema: </strong>Gastar menos e oferecer melhores servicos: esse eh o objetivo das cidades do futuro. Como
                            conseguir isso? Implementando hardware e softwares de baixo nivel, propondo novas arquiteturas de servico, manipulando grandes bases
                            de dados e integrando solucoes tecnologicas a outras areas de conhecimento.
                        </p>
                    </div>
                    <ul className="list-group list-group-flush">
                        <li className="list-group-item">
                            <strong>Orientador: </strong>Leonardo Sampaio
                        </li>
                        <li className="list-group-item">
                            <strong>Situação do profesor: </strong>
                            Orientação Aceita
                        </li>
                        <li className="list-group-item">
                            <strong>Integrantes: </strong>Leonardo Pereira, Marieni Cristina
                        </li>
                    </ul>
                    <div className="card-body">
                        <button type="submit" className="btn text-bg-light btn-sm border border-dark-subtle">
                            Editar
                        </button>
                    </div>
                </div>

                <div className="card my-4">
                    <div className="card-header">AVISO</div>
                    <div className="card-body">
                        <p className="card-text m-0">Nesta tela fica as informaçôes do seu tcc, seu tema, professor orientador e integrantes</p>
                        <p className="card-text m-0">Aqui você pode editar essas informações quando quiser, então TOME CUIDADO!</p>
                        <p className="card-text m-0">Lembrando que o professor da sua escolha precisa aceitar orienta-lo</p>
                        <p className="card-text m-0">Caso o professor nao aceite, escolha outro ao editar</p>
                    </div>
                </div>
            </div>
        </section>
    )
}
