import React from "react";
import { useSelector } from "react-redux";
import Message from "./Message";
import "../assets/errorBoundry.scss";

export default function ErrorBoundry(props) {
    const messages = useSelector((state) => state.alerts.messages);

    return (
        <>
            {props.children}
            <div className="error-boundry">
                {messages.map((message, i) => {
                    return <Message message={message} key={i} />;
                })}
            </div>
        </>
    );
}
