import React from "react";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import "./sessionlist.scss";

export default function ConnectionList({
    selectedSession,
    setSelectedSession,
    sessionList,
    sessionListLoading,
}) {
    const tableColumns = [
        {
            Header: "ID",
            accessor: "classRoom.id",
            disableSortBy: true,
        },
        {
            Header: "Nauczyciel",
            accessor: "user.username",
        },
        {
            Header: "Sala",
            accessor: "classRoom.name",
            disableSortBy: true,
            Filter: true,
        },
    ];

    if (sessionListLoading) return "Loading...";

    return (
        <div className="connection-list-container">
            <div className="title connection-list-title">
                Wybierz nauczyciela prowadzącego zajęcia, a następnie połącz się
                z maszyną
            </div>
            <div className="connection-list-panel">
                <div className="connection-list">
                    <BasicTable
                        selectedRow={selectedSession}
                        selectRow={setSelectedSession}
                        tableData={sessionList}
                        tableColumns={tableColumns}
                    />
                </div>
            </div>
        </div>
    );
}
