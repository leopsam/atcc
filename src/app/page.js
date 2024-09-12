import Image from "next/image";
import obj from "./public/img/obj.jpg";
import cont from "./public/img/cont.jpg";

export default function Home() {
  return (
    <main>
      {/*------------------------------------------------------------------------------------------------------*/}
      <nav className="navbar navbar-expand-lg bg-body-tertiary">
        <div className="container-fluid">
          <a className="navbar-brand" href="#">
            A.T.C.C Auxiliador de Trabalho de Conclusão de Curso
          </a>
          <div className="collapse navbar-collapse" id="navbarSupportedContent">
            <form className="d-flex" role="search">
              <input
                className="form-control me-2"
                type="search"
                placeholder="Login"
                aria-label="Search"
              />
              <input
                className="form-control me-2"
                type="search"
                placeholder="Senha"
                aria-label="Search"
              />
              <button className="btn btn-outline-success" type="submit">
                Entrar
              </button>
            </form>
          </div>
          <a href="#">Esqueceu sua senha?</a>
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
        <div className="carousel-inner">
          <div className="carousel-item active">
            <Image src={obj} className="d-block w-100" alt="..." />
            <div className="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>
                Some representative placeholder content for the first slide.
              </p>
            </div>
          </div>
          <div className="carousel-item">
            <Image src={cont} className="d-block w-100" alt="..." />
            <div className="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>
                Some representative placeholder content for the second slide.
              </p>
            </div>
          </div>
          <div className="carousel-item">
            <Image src={obj} className="d-block w-100" alt="..." />
            <div className="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>
                Some representative placeholder content for the third slide.
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
