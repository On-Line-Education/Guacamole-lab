import React, { useState } from "react";
import Logo from "../../components/Logo/Logo";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./assets/style.scss";
import ConnectionList from "./components/SessionList/SessionList";
import useGetAllGetSessions from "./hooks/UseGetAllSessions";

export default function ConnectView() {
    const {
        data: sessionList,
        loading: sessionListLoading,
        error: sessionListLoadingError,
    } = useGetAllGetSessions();

    const [selectedSession, setSelectedSession] = useState("");

    return (
        <>
            <div className="connect">
                <Sidebar active={"connect"} />
                <div className="connect-container">
                    <ConnectionList
                        selectedSession={selectedSession}
                        setSelectedSession={setSelectedSession}
                        sessionList={sessionList}
                        sessionListLoading={sessionListLoading}
                    />
                </div>
            </div>
            <Logo />
        </>
    );
}
