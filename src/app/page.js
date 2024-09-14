import Image from "next/image";
import objDesktop from "./public/img/desktop/obj.jpg";
import objMobile from "./public/img/mobile/obj.jpg";
import contDesktop from "./public/img/desktop/cont.jpg";
import contMobile from "./public/img/mobile/cont.jpg";
import versDesktop from "./public/img/desktop/vers.jpg";
import versMobile from "./public/img/mobile/vers.jpg";

export default function Home() {
  return (
    <main>
      <nav className="navbar navbar-expand-lg custom-navbar-bg text-primary">
        <div className="container-fluid d-flex justify-content-around">
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
            <a href="/pages/adm">Esqueceu sua senha?</a>
          </div>
        </div>
      </nav>
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
        <div className="carousel-inner">
          <div className="carousel-item active">
            <Image
              src={objMobile}
              className="d-block w-100 img-fluid d-md-none"
              alt="..."
            />
            <Image
              src={objDesktop}
              className="d-block w-100 img-fluid d-none d-xl-block"
              alt="..."
            />
            <div className="overlay" />
            <div className="carousel-caption d-none d-md-block custom-carousel-caption">
              <h1>OBJETIVO</h1>
              <p>
                Ajudar na orientação do aluno disponibilizando sujestões de
                temas, Orientatores e todo o processo dividido em etapas, neste
                caminho dificio que é o T.C.C.
              </p>
            </div>
          </div>
          <div className="carousel-item">
            <Image
              src={contMobile}
              className="d-block w-100 img-fluid d-md-none"
              alt="..."
            />
            <Image
              src={contDesktop}
              className="d-block w-100 img-fluid d-none d-xl-block"
              alt=""
            />
            <div className="overlay" />
            <div className="carousel-caption d-none d-md-block custom-carousel-caption">
              <h1>VERSATILIDADE</h1>
              <p>
                O Sistema será versatil e irá funcionar em desktop e plataformas
                mobile, facilitando o seu uso onde você estiver.
              </p>
            </div>
          </div>
          <div className="carousel-item">
            <Image
              src={versMobile}
              className="d-block w-100 img-fluid d-md-none"
              alt="..."
            />
            <Image
              src={versDesktop}
              className="d-block w-100 img-fluid d-none d-xl-block"
              alt=""
            />
            <div className="overlay" />
            <div className="carousel-caption d-none d-md-block custom-carousel-caption">
              <h1>CONTEUDO</h1>
              <p>
                O Sistema não só tem a comunicação entre aluno e orientador como
                tambem tem conteudos como ajuda com perguntas e respostas e uma
                biblioteca de arquivos.
              </p>
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
      <div className="m-5 ">
        <footer>
          <p>&copy; 2016 UNIABEU. &middot; Leonardo Pereira Sampaio</p>
        </footer>
      </div>
    </main>
  );
}
