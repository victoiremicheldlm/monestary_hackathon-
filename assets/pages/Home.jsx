import React from "react";
import "./home.css";

export default function Home() {
  return (
    <div className="container-fluid">
      <div className="background-home d-flex flex-column ">
        <div className="position-relative">
          <h1 className="text-white title mt-5 ">
            Amazon<span className="big-c">c</span>ar
          </h1>
          <img
            className=" logo"
            src="uploads/images/SH_logo_amazon.png"
            alt="logo-amazon"
          />
        </div>
      </div>
      <div className="intro flex-row d-flex justify-content-start position-absolute">
        <h3 className="text-white flex-row d-flex justify-content-start  intro-txt ms-3">
          {" "}
          Louez une<span className="color-letter mx-2"> voiture </span>
          en quelques clics !
        </h3>
        <button
          type="button"
          class="btn btn-warning btn-lg position-absolute intro-button "
        >
          Reservez
        </button>
      </div>
      <h4 className="position-relative intro-app text-white">
        Déverrouillez-la 24h/24 avec l'appli et partez !
      </h4>
      <section className=" mx-auto d-flex">
        <div className="section-title">
          <h4 className="section-sub-title">
            Ayez une voiture sans avoir de voiture
          </h4>
          <p className="section-info">
            Trouvez un véhicule <span className="color-info">AmazonCar </span>
            Filtrez votre recherche par type de véhicule, prix, et autres
            caractéristiques utiles.
          </p>
        </div>
        <div className="section-image">
          <img src="./uploads/images/home-mobile.png" alt="" />
        </div>
      </section>
        <h2 className="text-center mt-4 card-title">Nos <span className="color-car">véhicules</span></h2>
      <section className="flex-row d-flex card-section ">
       <div className="">
        <div className="section-card ">
          <div className="card">
            <img src="./uploads/images/cita-card.png" className="card-img-top bg-blue" alt="..." />
            <div classname="card-body px-3 ">
              <h5 classname="card-title">citadine</h5>
              <p classname="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
              <a href="#" class="btn btn-primary intro-button">
                Go somewhere
              </a>
            </div>
          </div>
          <div className="card">
            <img src="./uploads/images/suv.png" className="card-img-top bg-blue" alt="..." />
            <div classname="card-body px-3 ">
              <h5 classname="card-title">citadine</h5>
              <p classname="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
              <a href="#" class="btn btn-primary intro-button">
                Go somewhere
              </a>
            </div>
          </div>
          <div className="card">
            <img src="./uploads/images/cita-card.png" className="card-img-top bg-blue" alt="..." />
            <div classname="card-body px-3 ">
              <h5 classname="card-title">citadine</h5>
              <p classname="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
              <a href="#" class="btn btn-primary intro-button">
                Go somewhere
              </a>
            </div>
          </div>
        </div>
        </div> 
      </section>
    </div>
  );
}
