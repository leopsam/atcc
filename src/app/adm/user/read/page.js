import Link from 'next/link'
import { allUsersService } from '@/app/services/userService'

export default async function Page() {
    const { data: users } = await allUsersService()

    return (
        <main>
            <section className="dashboard-adm p-3">
                <h1 className="text-black">Usuários</h1>
                <table className="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Matricula</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">CPF</th>
                            <th scope="col">E-mail</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {users.map(user => (
                            <tr key={user.id}>
                                <td>{user.matriculation}</td>
                                <td>{user.name}</td>
                                <td>{user.role}</td>
                                <td>{user.cpf}</td>
                                <td>{user.email}</td>
                                <td>
                                    <Link type="button" href={`/adm/user/update/${user.id}`} className="btn btn-secondary btn-sm mx-1 text-white">
                                        Editar
                                    </Link>
                                    <Link type="button" href={`/adm/user/report/${user.id}`} className="btn btn-secondary btn-sm mx-1 text-white">
                                        Relatório
                                    </Link>
                                    <Link type="button" href={`/adm/user/remove/${user.id}`} className="btn btn-secondary btn-sm mx-1 text-white">
                                        Deletar
                                    </Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </section>
        </main>
    )
}
