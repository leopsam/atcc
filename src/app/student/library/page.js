import Image from 'next/image'
import imgteste from './../../../public/books/html2.png'
import imgteste2 from './../../../public/img/desktop/obj.jpg'

export default function Page() {
    return (
        <section className="dashboard">
            <div className="text-black bg-body-secondary py-4 px-5 text-center">
                <h1 className="fs-2 mt-2">Bem vindo à biblioteca digital ATCC</h1>
                <p className="fs-6">
                    Este é um sistema que revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar é um
                    sistema que revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar é um sistema que
                    revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar é um sistema que revoluciona
                    o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar.
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
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="books-cards align-items-center text-center">
                        <Image src={imgteste} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="books-cards align-items-center text-center">
                        <Image src={imgteste} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="books-cards align-items-center text-center">
                        <Image src={imgteste} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="books-cards align-items-center text-center">
                        <Image src={imgteste} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="books-cards align-items-center text-center">
                        <Image src={imgteste} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="videos-cards align-items-center text-center">
                        <Image src={imgteste2} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
                <div className="card custom-card mx-2 my-3">
                    <div className="books-cards align-items-center text-center">
                        <Image src={imgteste} className="card-img-top" alt="..." />
                    </div>

                    <div className="card-body">
                        <h5 className="card-title">Guia pratico de HTML</h5>
                        <p className="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        <a href="#" className="btn btn-secondary text-white w-100">
                            Abrir
                        </a>
                    </div>
                </div>
            </div>
        </section>
    )
}
