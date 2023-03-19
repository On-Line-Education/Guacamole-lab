import React from "react";
import { Link } from "react-router-dom";
import { IconButton } from "@mui/material";
import "./sidebar.scss";
import { useSelector } from "react-redux";

import LogoutIcon from "@mui/icons-material/Logout";
import useLogout from "../../features/auth/hooks/useLogout";

export default function Sidebar({ active }) {
    const loggedUserUsername = useSelector((state) => state.auth.username);
    const loggedUserRole = useSelector((state) => state.auth.role);
    const [error, logout] = useLogout();

    return (
        <div className="app-sidebar">
            <div className="app-nav">
                {["admin", "teacher"].includes(loggedUserRole) ? (
                    <ul>
                        <li
                            className={`app-nav-link ${
                                active === "connect" ? "checked" : ""
                            }`}
                        >
                            <Link to="/connect">Połącz</Link>
                        </li>
                        <li
                            className={`app-nav-link ${
                                active === "lessons" ? "checked" : ""
                            }`}
                        >
                            <Link to="/lessons">Lekcje</Link>
                        </li>
                        <li
                            className={`app-nav-link ${
                                active === "classrooms" ? "checked" : ""
                            }`}
                        >
                            <Link to="/classrooms">Sale</Link>
                        </li>
                        <li
                            className={`app-nav-link ${
                                active === "students" ? "checked" : ""
                            }`}
                        >
                            <Link to="/students">Uczniowie</Link>
                        </li>
                    </ul>
                ) : (
                    ""
                )}
            </div>
            <div className="sidebar-footer">
                <div className="sidebar-footer-logout">
                    <IconButton onClick={() => logout()}>
                        <LogoutIcon fontSize="large" color="secondary" />
                    </IconButton>
                </div>
                <div className="sidebar-footer-user-info">
                    {loggedUserUsername}
                </div>
            </div>
        </div>
    );
}
