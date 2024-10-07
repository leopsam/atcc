import DownloadPdfButton from '@/app/components/DownloadPdfButton';
import db from '@/utils/db';

async function getAllUsers() {
    try {
        const users = await db.user.findMany();
        return { data: users };
    } catch (error) {
        return { data: [] };
    }
}

export default async function Page() {
    const { data: users } = await getAllUsers();
    return (
        <main>
            <section className="dashboard-adm p-3">
                <h1 className="text-black">Usuários</h1>
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Matricula</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Situação</th>
                            <th scope="col">CPF</th>
                            <th scope="col">RG</th>
                            <th scope="col">Data de nascimento</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">username/login</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="text" id="txtColuna1" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna2" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna3" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna4" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                            <th>
                                <input type="text" id="txtColuna5" className="form-control form-control-sm" />
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        {users.map((user) => (
                            <tr key={user.id}>
                                <td>{user.matriculation}</td>
                                <td>{user.name}</td>
                                <td>{user.role}</td>
                                <td>{user.status}</td>
                                <td>{user.cpf}</td>
                                <td>{user.rg}</td>
                                <td>{new Date(user.birthDate).toLocaleDateString('pt-BR')}</td>
                                <td>{user.address}</td>
                                <td>{user.email}</td>
                                <td>{user.phone}</td>
                                <td>{user.username}</td>
                                <td>
                                    <button type="button" className="btn btn-secondary btn-sm mx-1 text-white">
                                        Editar
                                    </button>
                                </td>
                                <td>
                                    <DownloadPdfButton userId={user.id} />
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </section>
        </main>
    );
}
