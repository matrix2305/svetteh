import React from "react";
import {NavLink, Link} from "react-router-dom";
import './NavBar.css';

function NavBar() {
    return(
        <nav className="navbar navbar-expand-lg navbar-dark mr-5 ml-5">
            <Link className="navbar-brand" to="/"><h1>{content.name.toUpperCase()}</h1></Link>
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
            </button>

            <div className="collapse navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav ml-auto bg-navbar">
                    <li className="nav-item">
                        <NavLink activeClassName="nav-active" className="nav-link" exact to="/">Home</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink activeClassName="nav-active" className="nav-link" exact to="/aboutus">About us</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink activeClassName="nav-active" className="nav-link" exact to="/login">Login</NavLink>
                    </li>
                </ul>
            </div>
        </nav>
    )
}

export default NavBar;
