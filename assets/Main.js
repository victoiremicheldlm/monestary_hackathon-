import React from "react"
import ReactDOM from "react-dom/client"
import { BrowserRouter as Router, Routes, Route } from "react-router-dom"
import HelloWorld from "./pages/HelloWorld"
import Home from "./pages/Home"

import Nav from "./components/Nav"

function Main() {
  return (
    <Router>
      <Nav />
      <Routes>
        <Route exact path="/" element={<HelloWorld />} />
        <Route exact path="/home" element={<Home />} />
      </Routes>
    </Router>
  )
}

export default Main

if (document.getElementById("app")) {
  const root = ReactDOM.createRoot(document.getElementById("app"))
  root.render(
    <React.StrictMode>
      <Main />
    </React.StrictMode>
  )
}
