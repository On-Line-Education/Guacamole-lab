import React from "react";
import Avocado from "../../assets/avocado.svg";
import "./sidebar.scss";

export default function Sidebar() {
    return (
        <div className="login-sidebar">
            <div className="login-logo">
                <img src={Avocado} width="25px" />
                <span>Guacamole Lab</span>
            </div>
            <div className="description"></div>
        </div>
    );
}
