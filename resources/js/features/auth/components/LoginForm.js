import React from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../mui";

export default function LoginForm({ setUsername, setPassword, login }) {
    function handleSubmit(e) {
        e.preventDefault();
        login();
    }

    return (
        <form
            className="login-form"
            onSubmit={(e) => {
                handleSubmit(e);
            }}
        >
            <div className="welcome">
                Witaj w Guacamole Lab
                <span>Zaloguj się podając informacje poniżej</span>
            </div>
            <div className="login-form-input">
                <label className="login-form-label">Nazwa użytkownika</label>
                <GuacamoleInput
                    id="username"
                    variant="outlined"
                    size="small"
                    onChange={(e) => {
                        setUsername(e.target.value);
                    }}
                />
            </div>
            <div className="login-form-input" id="password">
                <label className="login-form-label">Hasło</label>
                <GuacamoleInput
                    id="password"
                    variant="outlined"
                    type="password"
                    size="small"
                    onChange={(e) => {
                        setPassword(e.target.value);
                    }}
                />
            </div>
            <div className="login-form-submit">
                <GuacamoleButton variant="contained" type="submit">
                    Zaloguj
                </GuacamoleButton>
            </div>
        </form>
    );
}
