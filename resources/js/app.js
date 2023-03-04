/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import ReactDOM from "react-dom/client";
import React from "react";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import RouteGuard from "./features/auth/components/RouteGuard";
import store from "./store";
import { Provider } from "react-redux";
import { ThemeProvider } from "@mui/material/styles";
import muiTheme from "./mui";
import Login from "./features/pages/Login";
import Dashboard from "./features/pages/Dashboard";
import ErrorBoundry from "./features/alert/components/ErrorBoundry";
import Students from "./features/pages/Students";

if (document.getElementById("app")) {
    const Index = ReactDOM.createRoot(document.getElementById("app"));

    let a = null;

    Index.render(
        <Provider store={store}>
            <ThemeProvider theme={muiTheme}>
                <ErrorBoundry>
                    <BrowserRouter>
                        <Routes>
                            {/* <Route path="/" element={<Navigate to="/login"/>} /> */}
                            <Route exact path="/" element={<Login />} />
                            <Route element={<RouteGuard />}>
                                <Route path="/home" element={<Dashboard />} />
                            </Route>
                            <Route element={<RouteGuard />}>
                                <Route
                                    path="/students"
                                    element={<Students />}
                                />
                            </Route>
                        </Routes>
                    </BrowserRouter>
                </ErrorBoundry>
            </ThemeProvider>
        </Provider>
    );
}
