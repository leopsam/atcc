import { getServerSession } from 'next-auth'

export default async function Page() {
    const session = await getServerSession()

    return (
        <section className="dashboard-adm">
            <div className="text-black bg-primary-subtle pt-5 pb-4 px-3">
                <h1 className="fs-2">Bem vindo {session?.user?.name} ao ATCC</h1>
                <p className="fs-6">
                    Este é um sistema que revoluciona o modo de gerir os trabalhos de conclusão de curso, oferecendo ferramentas de administração e controle.
                </p>
            </div>
            <div className="card m-5">
                <div className="card-header">AVISO</div>
                <div className="card-body">
                    <p className="card-text m-0">Parabéns, você agora tem acesso ao painel administrativo do ATCC.</p>
                    <p className="card-text m-0">Nele, você poderá gerenciar usuários e temas com facilidade e eficiência.</p>
                </div>
            </div>
            <div className="card m-5">
                <div className="card-header">RECURSOS DISPONÍVEIS</div>
                <div className="card-body">
                    <p className="card-text m-0">- Criar, editar, visualizar e excluir usuários -</p>
                    <p className="card-text m-0">- Criar, editar, visualizar e excluir temas de TCC -</p>
                    <p className="card-text m-0">- Monitorar o progresso dos alunos e orientadores -</p>
                    <p className="card-text m-0">- Gerenciar permissões e acessos de cada tipo de usuário -</p>
                </div>
            </div>
        </section>
    )
}
