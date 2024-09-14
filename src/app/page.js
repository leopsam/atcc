import Image from "next/image";
import obj from "./public/img/obj.jpg";
import cont from "./public/img/cont.jpg";
import vers from "./public/img/vers.jpg";

export default function Home() {
  return (
    <main>
      {/*------------------------------------------------------------------------------------------------------*/}
      <nav className="navbar navbar-expand-lg custom-navbar-bg text-primary">
        <div className="container-fluid d-flex align-items-center justify-content-around">
          <a className="navbar-brand custom-link-text-logo m-0 p-0" href="#">
            <h1 className="m-0 p-0 fs-1">A.T.C.C</h1>
            <h3 className="m-0 p-0 fs-5">
              Auxiliador de Trabalho de Conclusão de Curso
            </h3>
          </a>
          <div
            className="d-flex flex-column align-items-lg-start"
            id="navbarSupportedContent"
          >
            <form className="d-flex" role="Login">
              <input
                className="form-control form-control-sm me-2"
                type="text"
                placeholder="Login"
                aria-label="Login"
              />
              <input
                className="form-control form-control-sm me-2"
                type="password"
                placeholder="Senha"
                aria-label="Senha"
              />
              <button className="btn btn-light" type="submit">
                Entrar
              </button>
            </form>
            <a href="#">Esqueceu sua senha?</a>
          </div>
        </div>
      </nav>
      {/*------------------------------------------------------------------------------------------------------*/}

      <div
        id="carouselExampleCaptions"
        className="carousel slide"
        data-bs-ride="carousel"
      >
        <div className="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            className="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div className="carousel-inner custom-height-carousel">
          <div className="carousel-item active">
            <div className="custom-item">
              <Image src={obj} className="d-block w-100 image-carousel" />
              <div className="overlay"></div>
              <div className="carousel-caption d-none d-md-block custom-carousel-caption">
                <h1>OBJETIVO</h1>
                <p>
                  Ajudar na orientação do aluno disponibilizando sujestões de
                  temas, Orientatores e todo o processo dividido em etapas,
                  neste caminho dificio que é o T.C.C.
                </p>
              </div>
            </div>
          </div>
          <div className="carousel-item">
            <div className="custom-item">
              <Image
                src={vers}
                className="d-block w-100 image-carousel"
                layout="responsive"
              />
              <div className="overlay"></div>
              <div className="carousel-caption d-none d-md-block custom-carousel-caption">
                <h1>VERSATILIDADE</h1>
                <p>
                  O Sistema será versatil e irá funcionar em desktop e
                  plataformas mobile, facilitando o seu uso onde você estiver.
                </p>
              </div>
            </div>
          </div>
          <div className="carousel-item">
            <div className="custom-item">
              <Image src={cont} className="d-block w-100 image-carousel" />
              <div className="carousel-caption d-none d-md-block custom-carousel-caption">
                <h1>CONTEUDO</h1>
                <p>
                  O Sistema não só tem a comunicação entre aluno e orientador
                  como tambem tem conteudos como ajuda com perguntas e respostas
                  e uma biblioteca de arquivos.
                </p>
              </div>
            </div>
          </div>
        </div>
        <button
          className="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev"
        >
          <span
            className="carousel-control-prev-icon"
            aria-hidden="true"
          ></span>
          <span className="visually-hidden">Previous</span>
        </button>
        <button
          className="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next"
        >
          <span
            className="carousel-control-next-icon"
            aria-hidden="true"
          ></span>
          <span className="visually-hidden">Next</span>
        </button>
      </div>

      <div>
        <h1>OBJETIVO</h1>
        <p>
          asd asd asdasd asd asdas dasd asd asd asd as dasdasd asda sdas d asd
          sad asd asd
        </p>
      </div>
      {/*------------------------------------------------------------------------------------------------------*/}
      <footer>
        <p>todos os direitos reservadoas</p>
      </footer>
    </main>
  );
}
