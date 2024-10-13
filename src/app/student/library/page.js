import { Tooltip } from '@nextui-org/tooltip'
import Image from 'next/image'
import Link from 'next/link'
import { allLibraryService } from '@/app/services/libraryService'

export default async function Page() {
    const { data: library } = await allLibraryService()

    return (
        <section className="dashboard">
            <div className="text-black bg-primary-subtle py-4 px-5 text-center">
                <h1 className="fs-2 mt-2">Bem vindo à biblioteca digital ATCC</h1>
                <p className="fs-6">
                    Este é um sistema que revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar é um
                    sistema que revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar.
                </p>
            </div>
            <div className="p-2 d-flex align-items-center justify-content-center border-bottom">
                <div className="col-md-2 m-3">
                    <select className="form-select border-dark-subtle" aria-label="Default select example">
                        <option defaultValue>Categoria</option>
                        <option value="1">Livro</option>
                        <option value="2">Video aula</option>
                        <option value="3">Site</option>
                    </select>
                </div>
                <div className="col-md-6 m-3">
                    <div className="input-group">
                        <input
                            type="text"
                            className="form-control border-dark-subtle  text-black"
                            placeholder="Buscar"
                            aria-label="Recipient's username"
                            aria-describedby="button-addon2"
                        />
                        <button className="btn btn-outline-secondary btn-secondary text-white" type="button" id="button-addon2">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </div>
            <div className="p-4 d-flex flex-wrap justify-content-center align-items-center">
                {library &&
                    library.map(libraryItem => (
                        <div key={libraryItem.id} className="card custom-card mx-2 my-3">
                            <div className={`${libraryItem.type.toLowerCase()} align-items-center text-center`}>
                                <Image src={libraryItem.image} width={200} height={200} className="card-img-top" alt="..." />
                            </div>
                            <div className="card-body d-flex flex-column justify-content-between">
                                <Tooltip showArrow={true} className="capitalize rounded p-2 text-bg-info cursor" content={libraryItem.title}>
                                    <h5 className="card-title m-0 fs-5 fw-bold custom-card-body-library-title">{libraryItem.title}</h5>
                                </Tooltip>
                                <p className="custom-card-body-library m-0 card-text">{libraryItem.description}</p>
                                <Link href={libraryItem.file} className="btn btn-secondary text-white mt-auto w-100" target="_blank" rel="noopener noreferrer">
                                    Abrir
                                </Link>
                            </div>
                        </div>
                    ))}
            </div>
        </section>
    )
}
