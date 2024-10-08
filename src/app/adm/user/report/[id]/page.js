import Image from 'next/image';

import { getUserByIdService } from '@/app/services/userService';

export default async function getUserById({ params }) {
    const { data: user } = await getUserByIdService(params.id);

    return (
        <main>
            <section className="dashboard-adm p-3">
                <h1 className="text-black ">Dados do Usuario:</h1>
                <div class="card my-2 card-width-custom">
                    <Image src={user.photo} class="card-img-top" width={70} height={70} alt="Picture of the author" />
                    <div class="card-body">
                        <h5 class="card-title">{user.name}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Matricula:</strong> {user.matriculation}
                        </li>
                        <li class="list-group-item">
                            <strong>Perfil:</strong> {user.role}
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong> {user.status}
                        </li>
                        <li class="list-group-item">
                            <strong>CPF:</strong> {user.cpf}
                        </li>
                        <li class="list-group-item">
                            <strong>RG:</strong> {user.rg}
                        </li>
                        <li class="list-group-item">
                            <strong>Endereço:</strong> {user.address}
                        </li>
                        <li class="list-group-item">
                            <strong>Telefone:</strong> {user.phone}
                        </li>
                        <li class="list-group-item">
                            <strong>E-mail:</strong> {user.email}
                        </li>
                        <li class="list-group-item">
                            <strong>Nome de usuario:</strong> {user.username}
                        </li>
                    </ul>
                </div>
            </section>
        </main>
    );
}
