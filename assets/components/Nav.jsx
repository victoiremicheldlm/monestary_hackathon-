import React from "react";
import { Link } from "react-router-dom";
import "./nav.css";

export default function Nav() {
  return (
    <nav className="">
      <ul className="bg-nav nav justify-content-center   ">
        <Link className="nav-item nav-link active txt-nav" to="/">
          Home
        </Link>
        <Link className="nav-item nav-link active txt-nav " to="/">
          Reservation
        </Link>
        <Link className="nav-item nav-link active txt-nav" to="/">
          help
        </Link>
        <Link className="nav-item nav-link active txt-nav" to="/">
          Profile
        </Link>
      </ul>
    </nav>
  );
}
