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
import ErrorBoundry from "./features/alert/components/ErrorBoundry";
import Students from "./features/pages/Students";
import Page404 from "./features/auth/components/Page404/Page404";
import Classrooms from "./features/pages/Classrooms";
import Lessons from "./features/pages/Lessons";
import Connect from "./features/pages/Connect";

if (document.getElementById("app")) {
    const Index = ReactDOM.createRoot(document.getElementById("app"));

    Index.render(
        <Provider store={store}>
            <ThemeProvider theme={muiTheme}>
                <ErrorBoundry>
                    <BrowserRouter>
                        <Routes>
                            <Route
                                path="/"
                                element={<Navigate to="/login" />}
                            />
                            <Route exact path="/login" element={<Login />} />
                            <Route
                                exact
                                path="/connect"
                                element={
                                    <RouteGuard
                                        accessList={[
                                            "student",
                                            "instructor",
                                            "admin",
                                        ]}
                                    >
                                        <Connect />
                                    </RouteGuard>
                                }
                            />
                            <Route
                                path="/lessons"
                                element={
                                    <RouteGuard
                                        accessList={["instructor", "admin"]}
                                    >
                                        <Lessons />
                                    </RouteGuard>
                                }
                            />
                            <Route
                                path="/classrooms"
                                element={
                                    <RouteGuard
                                        accessList={["instructor", "admin"]}
                                    >
                                        <Classrooms />
                                    </RouteGuard>
                                }
                            />
                            <Route
                                path="/students"
                                element={
                                    <RouteGuard
                                        accessList={["instructor", "admin"]}
                                    >
                                        <Students />
                                    </RouteGuard>
                                }
                            />
                            <Route path="*" element={<Page404 />} />
                        </Routes>
                    </BrowserRouter>
                </ErrorBoundry>
            </ThemeProvider>
        </Provider>
    );
}
