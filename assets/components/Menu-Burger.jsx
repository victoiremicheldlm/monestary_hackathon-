import React from "react";
import { stack as Menu } from "react-burger-menu";
import "../styles/burger.css";


function Menu_Burger() {
  
  return (
<div className="NavBar">

    <div className="menuBurger">
    <Menu>
      <a className="menu-item" href="/">
        🖱️ - Home 
      </a>
      <a className="menu-item" href="/AProposDeMoi">
       👨‍💻 - Car Market
      </a>
      <a className="menu-item" href="/MesProjets">
       🚀 - 
      </a>
      <a className="menu-item" href="/MeContacter">
       📠 - xxxxxxxx
      </a>
    </Menu>
    </div>

    </div>
  );
}
  

 




export default Menu_Burger;


