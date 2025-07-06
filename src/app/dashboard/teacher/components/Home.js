export default function Home() {
    return (
        <main>
            <section className="dashboard">
                <div className="text-black bg-body-secondary pt-5 pb-4 px-3">
                    <h1 className="fs-2">Bem vindo Professor Leonardo Sampaio ao ATCC</h1>
                    <p className="fs-6">
                        Este é um sistema que revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar.
                    </p>
                </div>
                <div className="card m-5">
                    <div className="card-header">AVISO</div>
                    <div className="card-body">
                        <p className="card-text m-0">Parabéns você agora tem acesso ao ATCC (Auxiliador de Trabalho de Conclusao de Curso). </p>
                        <p className="card-text m-0">Nele você tem recursos que facilitará o desivolvimento do seu TCC.</p>
                    </div>
                </div>
                <div className="card m-5">
                    <div className="card-header">RECURSOS DISPONÍVEIS</div>
                    <div className="card-body">
                        <p className="card-text m-0">
                            ✅ Cadastro de temas: Permitir que o orientador cadastre temas ou que o aluno sugira um tema para seu TCC.
                        </p>
                        <p className="card-text m-0">
                            ✅ Consulta e aceitação de orientação: Permitir que o orientador consulte os temas escolhidos pelos alunos e aceite ou não a
                            orientação.
                        </p>
                        <p className="card-text m-0">
                            ✅ Cadastro de etapas: Acompanhar o progresso de cada aluno durante o desenvolvimento do TCC, definindo prazos e entregáveis.
                        </p>
                        <p className="card-text m-0">
                            ✅ Cadastro de arquivos: Compartilhar materiais de apoio com os alunos, como livros, artigos e videoaulas.
                        </p>
                    </div>
                </div>
            </section>
        </main>
    )
}
