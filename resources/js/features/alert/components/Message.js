import React, { useState } from "react";
import { Alert, AlertTitle, IconButton } from "@mui/material";
import "../assets/errorMessage.scss";
import CloseIcon from "@mui/icons-material/Close";
import { useDispatch } from "react-redux";
import { deleteError } from "../state/alertActions";
import { useEffect } from "react";

export default function ErrorMessage({ message }) {
    const dispatch = useDispatch();
    const timeout = 5000;

    useEffect(() => {
        setTimeout(() => dispatch(deleteError(message.id)), timeout);
    }, []);

    return (
        <Alert
            severity={message.type}
            className="message"
            action={
                <IconButton
                    color="inherit"
                    onClick={() => {
                        dispatch(deleteError(message.id));
                    }}
                >
                    <CloseIcon />
                </IconButton>
            }
        >
            <AlertTitle>{message.title}</AlertTitle>
            <div className="error-message">{message.message}</div>
        </Alert>
    );
}
