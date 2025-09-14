'use client'
import { getTccInfoByUserIdInMembersAction } from '@/server/controllers/tcc/readTccActions'
import ButtonsTable from '@/app/components/ButtonsTable'
import 'bootstrap-icons/font/bootstrap-icons.css'
import Link from 'next/link'
import { useEffect, useState } from 'react'

export default function Page() {
    const [myTcc, setMyTcc] = useState(null)

    useEffect(() => {
        async function tcc() {
            const res = await getTccInfoByUserIdInMembersAction()
            setMyTcc(res.data)
        }

        tcc()
    }, [])

    if (!myTcc) {
        return (
            <section className="dashboard">
                <div className="text-black bg-primary-subtle pt-5 pb-4 px-3">
                    <h1 className="fs-2">Você ainda não possui TCC cadastrado!</h1>
                    <p className="fs-6">
                        O cadastro de proposta serve para registrar as informações principais do seu TCC. <br />
                        Acesse no menu lateral para &quot;Cadastrar Proposta&quot; ou clique no botão abaixo para ser redirecionado.
                        <br />
                        <Link className="btn btn-primary my-2" href="/interface/student/tcc/create">
                            Acesse a pagina de Cadastrar Proposta
                        </Link>
                    </p>
                </div>
            </section>
        )
    }

    return (
        <section className="dashboard">
            <div className="px-4 py-5">
                <h1 className="text-black fs-4">Imformações TCC</h1>
                <div className="card">
                    <div className="card-body text-bg-secondary">
                        <h5 className="card-title">{myTcc.theme}</h5>
                        <p className="card-text">
                            <strong>Descrição do tema: </strong>
                            {myTcc.description}
                        </p>
                    </div>
                    <ul className="list-group list-group-flush">
                        <li className="list-group-item">
                            <strong>Orientador: </strong>
                            {myTcc.advisor}
                        </li>

                        <li className="list-group-item">
                            <strong>Integrantes: </strong>
                            {myTcc?.members?.join(', ') || 'Carregando...'}
                        </li>
                        <li className="list-group-item">
                            <strong>Cadastro feito em: </strong>
                            {`${new Date(myTcc.createdAt).toLocaleDateString('pt-BR')} às ${new Date(myTcc.createdAt).toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit', hour12: false })}`}
                        </li>
                    </ul>
                    <div className="card-body">
                        <ButtonsTable href={`/adm/tcc/update/${'userId'}`} />
                    </div>
                </div>
            </div>
        </section>
    )
}
