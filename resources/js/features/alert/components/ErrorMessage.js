import React, { useState } from "react";
import { Alert, AlertTitle, IconButton } from "@mui/material";
import "../assets/errorMessage.scss";
import CloseIcon from "@mui/icons-material/Close";
import { useDispatch } from "react-redux";
import { deleteError } from "../state/alertActions";
import { useEffect } from "react";

export default function ErrorMessage({ error }) {
    const dispatch = useDispatch();
    const timeout = 5000;

    useEffect(() => {
        setTimeout(() => dispatch(deleteError(error.code)), timeout);
    }, []);

    return (
        <Alert
            severity="error"
            className="error"
            action={
                <IconButton
                    color="inherit"
                    onClick={() => {
                        dispatch(deleteError(error.code));
                    }}
                >
                    <CloseIcon />
                </IconButton>
            }
        >
            <AlertTitle>{error.title}</AlertTitle>
            <div className="error-message">{error.message}</div>
        </Alert>
    );
}
