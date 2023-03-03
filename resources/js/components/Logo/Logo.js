import React from "react";
import Avocado from "../../../assets/avocado-dark.svg";
import "./logo.scss";

export default function Logo() {
    return (
        <div className="logo">
            <img src={Avocado} width="25px" />
            <span>Guacamole Lab</span>
        </div>
    );
}
