export default function AlunoDashboard() {
    return (
        <section className="dashboard">
            <div className="text-black bg-primary-subtle pt-5 pb-4 px-3">
                <h1 className="fs-2">Bem vindo Leonardo Sampaio ao ATCC</h1>
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
                    <p className="card-text m-0">-Escolher temas já cadastrados ou sujetione seu proprio tema-</p>
                    <p className="card-text m-0">-Cadastro das inforções do seu TCC-</p>
                    <p className="card-text m-0">-Verificar reputação dos professores orientadores-</p>
                    <p className="card-text m-0">-Enviar o TCC por etapas-</p>
                    <p className="card-text m-0">-Biblioteca online com livros, sites e videos aulas-</p>
                </div>
            </div>
        </section>
    )
}
