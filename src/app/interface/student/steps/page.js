'use client'
import ButtonSubmit from '@/app/components/ButtonSubmit'
import { useEffect, useState } from 'react'

export default function Page() {
    const [steps, setSteps] = useState()

    useEffect(() => {
        async function AllSteps() {
            const res = await fetch('/api/steps')
            const json = await res.json()
            setSteps(json.data)
        }

        AllSteps()
    }, [])

    if (!steps) {
        return (
            <section className="dashboard">
                <div className="px-4 py-5">
                    <h1 className="text-black fs-4">Etapas</h1>
                    <p className="text-muted">Nenhuma etapa encontrada.</p>
                </div>
            </section>
        )
    }
    return (
        <section className="dashboard">
            <div className="px-4 py-5">
                <h1 className="text-black fs-4">Etapas</h1>
                <div className="accordion" id="accordionExample">
                    {steps &&
                        steps.map(step => (
                            <div className="accordion-item" key={step.id}>
                                <h2 className="accordion-header">
                                    <button
                                        className="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"
                                        aria-expanded="true"
                                        aria-controls="collapseOne"
                                    >
                                        {step.title} - Prazo de entrega: {step.startDate} até {step.endDate}
                                    </button>
                                </h2>
                                <div id="collapseOne" className="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div className="accordion-body">
                                        <p>
                                            <strong>Descrição - </strong>
                                            {step.description}
                                        </p>
                                        <p>
                                            <strong>Situação - </strong> {step.status}
                                        </p>
                                        <form className="row g-2 text-black my-2">
                                            <div className="col-12 my-2">
                                                <label htmlFor="formFile" className="form-label ">
                                                    Insira um arquivo referente á resolução dessa etapa:
                                                </label>
                                                <input className="form-control form-control-sm" type="file" id="formFile" />
                                            </div>

                                            <div className="col-12 d-flex align-items-center py-2">
                                                <ButtonSubmit>Enviar</ButtonSubmit>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ))}

                    <div className="accordion-item">
                        <h2 className="accordion-header">
                            <button
                                className="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne"
                            >
                                Introdução - Prazo de entrega: 15/05/2024 até 20/05/2024
                            </button>
                        </h2>
                        <div id="collapseOne" className="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div className="accordion-body">
                                <p>
                                    <strong>Descrição - </strong>It is shown by default, until the collapse plugin adds the appropriate classes that we use to
                                    style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You
                                    can modify any of this with custom CSS or overriding our default variables. Its also worth noting that just about any HTML
                                    can go within.
                                </p>
                                <p>
                                    <strong>Situação - </strong>Atrasado
                                </p>
                                <form className="row g-2 text-black my-2">
                                    <div className="col-12 my-2">
                                        <label htmlFor="formFile" className="form-label ">
                                            Insira um arquivo referente á resolução dessa etapa:
                                        </label>
                                        <input className="form-control form-control-sm" type="file" id="formFile" />
                                    </div>

                                    <div className="col-12 d-flex align-items-center py-2">
                                        <ButtonSubmit>Enviar</ButtonSubmit>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div className="accordion-item">
                        <h2 className="accordion-header">
                            <button
                                className="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo"
                            >
                                Script do banco - Prazo de entrega: 15-05-2024 até 20-05-2024
                            </button>
                        </h2>
                        <div id="collapseTwo" className="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div className="accordion-body">
                                <p>
                                    <strong>Descrição - </strong>It is shown by default, until the collapse plugin adds the appropriate classes that we use to
                                    style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You
                                    can modify any of this with custom CSS or overriding our default variables. Its also worth noting that just about any HTML
                                    can go within.
                                </p>
                                <p>
                                    <strong>Situação - </strong>Atrasado
                                </p>
                                <form className="row g-2 text-black my-2">
                                    <div className="col-12 my-2">
                                        <label htmlFor="formFile" className="form-label ">
                                            Insira um arquivo referente á resolução dessa etapa:
                                        </label>
                                        <input className="form-control form-control-sm" type="file" id="formFile" />
                                    </div>

                                    <div className="col-12 d-flex align-items-center py-2">
                                        <ButtonSubmit>Enviar</ButtonSubmit>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div className="accordion-item">
                        <h2 className="accordion-header">
                            <button
                                className="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree"
                            >
                                Front-end (React / NextJs) - Prazo de entrega: 15-05-2024 até 20-05-2024
                            </button>
                        </h2>
                        <div id="collapseThree" className="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div className="accordion-body">
                                <p>
                                    <strong>Descrição - </strong>It is shown by default, until the collapse plugin adds the appropriate classes that we use to
                                    style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You
                                    can modify any of this with custom CSS or overriding our default variables. Its also worth noting that just about any HTML
                                    can go within.
                                </p>
                                <p>
                                    <strong>Situação - </strong>Atrasado
                                </p>
                                <form className="row g-2 text-black my-2">
                                    <div className="col-12 my-2">
                                        <label htmlFor="formFile" className="form-label ">
                                            Insira um arquivo referente á resolução dessa etapa:
                                        </label>
                                        <input className="form-control form-control-sm" type="file" id="formFile" />
                                    </div>

                                    <div className="col-12 d-flex align-items-center py-2">
                                        <ButtonSubmit>Enviar</ButtonSubmit>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}
