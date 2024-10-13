import Image from 'next/image'
import Link from 'next/link'
import contDesktop from './../public/img/desktop/cont.jpg'
import objDesktop from './../public/img/desktop/obj.jpg'
import versDesktop from './../public/img/desktop/vers.jpg'
import contMobile from './../public/img/mobile/cont.jpg'
import objMobile from './../public/img/mobile/obj.jpg'
import versMobile from './../public/img/mobile/vers.jpg'
import SigninForm from '@/app/components/SigninForm'

export default async function Home() {
    return (
        <>
            <nav className="navbar navbar-expand-md custom-navbar-bg">
                <div className="container-fluid d-flex justify-content-between align-items-center mx-3">
                    <div className="custom-link-text-logo m-0 p-0">
                        <h1 className="m-0 p-0 fs-1">A.T.C.C</h1>
                        <h3 className="m-0 p-0 fs-6">Auxiliador de Trabalho de Conclusão de Curso</h3>
                    </div>
                    <button
                        className="navbar-toggler custom-button-hamburguer-index custom-button-hamburguer-size-color p-0 border-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span className="bi bi-list"></span>
                    </button>
                    <div>
                        <div className="collapse navbar-collapse" id="navbarSupportedContent">
                            <div className="d-flex flex-column align-items-lg-start m-2">
                                <SigninForm />

                                <Link href="#" className="p-0 text-light" data-bs-toggle="modal" data-bs-target="#modalRecoverPassword">
                                    Esqueceu sua senha?
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <main>
                <div id="carouselExampleCaptions" className="carousel slide" data-bs-ride="carousel">
                    <div className="carousel-indicators">
                        <button
                            type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="0"
                            className="active"
                            aria-current="true"
                            aria-label="Slide 1"
                        ></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div className="carousel-inner">
                        <div className="carousel-item active">
                            <Image src={objMobile} className="d-block w-100 img-fluid d-md-none" alt="Imagem do carrossel contexto objetivo, para mobile" />
                            <Image
                                src={objDesktop}
                                className="d-block w-100 img-fluid d-none d-md-block"
                                alt="Imagem do carrossel contexto objetivo, para desktop"
                            />
                            <div className="overlay" />
                            <div className="carousel-caption d-md-block custom-carousel-caption">
                                <h1>OBJETIVO</h1>
                                <p>
                                    Ajudar na orientação do aluno disponibilizando sujestões de temas, Orientatores e todo o processo dividido em etapas, neste
                                    caminho dificio que é o T.C.C.
                                </p>
                            </div>
                        </div>
                        <div className="carousel-item">
                            <Image
                                src={versMobile}
                                className="d-block w-100 img-fluid d-md-none"
                                alt="Imagem do carrossel contexto versatilidade, para mobile"
                            />
                            <Image
                                src={versDesktop}
                                className="d-block w-100 img-fluid d-none d-md-block"
                                alt="Imagem do carrossel contexto versatilidade, para desktop"
                            />
                            <div className="overlay" />
                            <div className="carousel-caption d-md-block custom-carousel-caption">
                                <h1>VERSATILIDADE</h1>
                                <p>O Sistema será versatil e irá funcionar em desktop e plataformas mobile, facilitando o seu uso onde você estiver.</p>
                            </div>
                        </div>
                        <div className="carousel-item">
                            <Image src={contMobile} className="d-block w-100 img-fluid d-md-none" alt="Imagem do carrossel contexto conteudo, para mobile" />
                            <Image
                                src={contDesktop}
                                className="d-block w-100 img-fluid d-none d-md-block"
                                alt="Imagem do carrossel contexto conteudo, para desktop"
                            />
                            <div className="overlay" />
                            <div className="carousel-caption d-md-block custom-carousel-caption">
                                <h1>CONTEUDO</h1>
                                <p>
                                    O Sistema não só tem a comunicação entre aluno e orientador como tambem tem conteudos como ajuda com perguntas e respostas e
                                    uma biblioteca de arquivos.
                                </p>
                            </div>
                        </div>
                    </div>
                    <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span className="visually-hidden">Previous</span>
                    </button>
                    <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span className="carousel-control-next-icon" aria-hidden="true"></span>
                        <span className="visually-hidden">Next</span>
                    </button>
                </div>
            </main>

            <footer className="m-5">
                <p>&copy; 2016 UNIABEU. &middot; Leonardo Pereira Sampaio</p>
            </footer>

            <div
                className="modal fade"
                id="modalRecoverPassword"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabIndex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog text-black">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h1 className="modal-title fs-5" id="staticBackdropLabel">
                                Recuperação de senha
                            </h1>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div className="modal-body">
                            <p className="">
                                Para recuperar a senha informe seu CPF e email, em seguida aparecera uma notificação com uma senha padrão, mude a senha se achar
                                necessário.
                            </p>
                            <form>
                                <div className="form-floating mb-3">
                                    <input type="text" className="form-control" id="floatingCpf" placeholder="CPF" />
                                    <label htmlFor="floatingCpf">CPF</label>
                                </div>
                                <div className="form-floating mb-3">
                                    <input type="email" className="form-control" id="floatingInput" placeholder="name@example.com" />
                                    <label htmlFor="floatingInput">Email</label>
                                </div>
                            </form>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary text-white" data-bs-dismiss="modal">
                                Fechar
                            </button>
                            <button type="button" className="btn btn-secondary text-white" data-bs-dismiss="modal">
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
