import Image from 'next/image'
import ButtonsTable from '@/app/components/ButtonsTable'
import { allUsersService } from '@/server/services/userService'

export default async function Page() {
    const { data: users } = await allUsersService()

    return (
        <main>
            <section className="dashboard-adm px-3 mt-3">
                <h1 className="text-black">Usuários</h1>
                <table className="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
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
                                <td className="text-center">
                                    <Image
                                        src={user.photo}
                                        className="card-img-top object-fit-cover rounded-circle img-table"
                                        width={70}
                                        height={70}
                                        alt="Picture of the author"
                                    />
                                </td>
                                <td>{user.matriculation}</td>
                                <td>{user.name}</td>
                                <td>{user.role}</td>
                                <td>{user.cpf}</td>
                                <td>{user.email}</td>
                                <td>
                                    <ButtonsTable href={`/adm/user/update/${user.id}`}>Editar</ButtonsTable>
                                    <ButtonsTable href={`/adm/user/report/${user.id}`}>Relatório</ButtonsTable>
                                    <ButtonsTable href={`/adm/user/remove/${user.id}`}>Deletar</ButtonsTable>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </section>
        </main>
    )
}
