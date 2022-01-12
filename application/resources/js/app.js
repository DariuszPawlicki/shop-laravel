require("./bootstrap");
import React from "react";
import ReactDOM from "react-dom";
import App from "./Components/App";

import LoginPage from "./LoginPage";
import RegisterPage from "./RegisterPage";

import { Provider } from "react-redux";
import store from "./Redux/configureStore";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";

ReactDOM.render(
    <Router>
        <Provider store={store}>
            <Routes>
                <Route exact path="/" element={<LoginPage />} />
                <Route exact path="/login" element={<LoginPage />} />
                <Route exact path="/register" element={<RegisterPage />} />
                <Route exact path="/home" element={<App />} />
            </Routes>
        </Provider>
    </Router>,
    document.getElementById("root")
);
