/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import ReactDOM from "react-dom/client";
import React from "react";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import { ThemeProvider } from "@mui/material/styles";
import muiTheme from "./mui";
import RouteGuard from "./features/auth/components/RouteGuard";


/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Login from './features/pages/Login';
import Dashboard from "./features/pages/Dashboard";


if (document.getElementById("app")) {
    const Index = ReactDOM.createRoot(document.getElementById("app"));

    Index.render(
        <ThemeProvider theme={muiTheme}>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Navigate to="/login"/>} />
                    <Route exact path="/login" element={<Login />} />
                    <Route element={ <RouteGuard /> }>
                        <Route path='/home' element={ <Dashboard /> } />
                    </Route>
                </Routes>
            </BrowserRouter>
        </ThemeProvider>
    )
}

