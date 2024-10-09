import Image from 'next/image'
import ButtonBack from '@/app/components/ButtonBack'
import { getUserByIdService } from '@/app/services/userService'

export default async function getUserById({ params }) {
    const { data: user } = await getUserByIdService(params.id)

    return (
        <main>
            <section className="dashboard-adm px-3 mt-3">
                <h1 className="text-black ">Dados do Usuario:</h1>
                <div className="card card-width-custom mb-2">
                    <Image src={user.photo} className="card-img-top" width={70} height={70} alt="Picture of the author" />
                    <div className="card-body">
                        <h5 className="card-title">{user.name}</h5>
                    </div>
                    <ul className="list-group list-group-flush">
                        <li className="list-group-item">
                            <strong>Matricula:</strong> {user.matriculation}
                        </li>
                        <li className="list-group-item">
                            <strong>Perfil:</strong> {user.role}
                        </li>
                        <li className="list-group-item">
                            <strong>Status:</strong> {user.status}
                        </li>
                        <li className="list-group-item">
                            <strong>CPF:</strong> {user.cpf}
                        </li>
                        <li className="list-group-item">
                            <strong>RG:</strong> {user.rg}
                        </li>
                        <li className="list-group-item">
                            <strong>Endereço:</strong> {user.address}
                        </li>
                        <li className="list-group-item">
                            <strong>Telefone:</strong> {user.phone}
                        </li>
                        <li className="list-group-item">
                            <strong>E-mail:</strong> {user.email}
                        </li>
                        <li className="list-group-item">
                            <strong>Nome de usuario:</strong> {user.username}
                        </li>
                    </ul>
                </div>
                <ButtonBack />
            </section>
        </main>
    )
}
