import React from "react";
import { stack as Menu } from "react-burger-menu";
import "../styles/menu-burger.css"



function Menu_Burger() {
  
  return (
<div className="NavBar">

    <div className="menuBurger">
    <Menu>
      <a className="menu-item" href="/">
        🏠 - Home 
      </a>
      <a className="menu-item" href="/AProposDeMoi">
       🖱️ - Réservation
      </a>
      <a className="menu-item" href="/MesProjets">
       🚩 - Help
      </a>
      <a className="menu-item" href="/MeContacter">
     ⚙️ - Profile
      </a>
    </Menu>
    </div>

    </div>
  );
}
  
export default Menu_Burger;
