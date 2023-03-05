import React from "react";
import useLogout from "../auth/hooks/useLogout";

export default function Dashboard() {
    const [error, logout] = useLogout();

    if (error) {
        console.log(error);
    }

    return (
        <div>
            You are logged in
            <button
                onClick={() => {
                    logout();
                }}
            >
                WYLOGUJ
            </button>
        </div>
    );
}
