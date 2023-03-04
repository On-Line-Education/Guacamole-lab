import { SvgIcon } from "@mui/material";
import React from "react";
import Avocado from "../../assets/avocado.svg";
import "./page404.scss";

export default function Page404() {
    return (
        <div className="page-not-found">
            <div className="error-visualization">
                <div className="error-code">404</div>
                <div className="error-logo">
                    <img src={Avocado} />
                </div>
            </div>
            <div className="description">Nie znaleziono strony</div>
        </div>
    );
}
