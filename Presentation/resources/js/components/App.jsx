import React, {useEffect, useState} from "react";
import ReactDOM from 'react-dom';
import {BrowserRouter, Route} from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import Header from "./Header/Header";
import Footer from "./Footer/Footer";


function App() {
    return(
        <BrowserRouter>
            <Route path='/' exact>
                <Header/>
                <Footer/>
            </Route>
        </BrowserRouter>
    )
}

ReactDOM.render(<App/>, document.getElementById('app'));



