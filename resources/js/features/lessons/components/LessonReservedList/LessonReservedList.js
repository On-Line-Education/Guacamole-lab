import React from "react";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./lessonreservedlist.scss";
import SortingTable from "../../../../components/SortingTable/SortingTable";

export default function LessonReservedList({
    reservedList,
    loading,
    selectedReservation,
    setSelectedReservation,
    setReservationDetailsPanelState,
}) {
    console.log(reservedList);

    const tableColumns = [
        {
            Header: "Czas startu",
            name: "time",
            accessor: "start",
            disableSortBy: true,
        },
        {
            Header: "Nauczyciel",
            name: "instructor",
            accessor: "instructor.username",
            disableSortBy: true,
        },
        {
            Header: "Klasa",
            name: "class",
            accessor: "class.name",
            disableSortBy: true,
        },
        {
            Header: "Sala",
            name: "classroom",
            accessor: "class_room.name",
            disableSortBy: true,
        },
        {
            Header: "Nazwa",
            name: "name",
            accessor: "name",
            disableSortBy: true,
            Filter: true,
        },
    ];

    return (
        <div className="reserved-list-container">
            <div className="title reserved-list-title">Lista rezerwacji</div>
            <div className="panel reserved-list-panel">
                <div className="reserved-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <SortingTable
                            selectRow={setSelectedReservation}
                            selectedRow={selectedReservation}
                            tableData={reservedList.lectures}
                            tableColumns={tableColumns}
                        />
                    )}
                </div>
                <div className="list-actions reserved-list-actions">
                    <GuacamoleButton
                        sx={{ width: "40%" }}
                        onClick={() => setReservationDetailsPanelState(true)}
                        disabled={!selectedReservation}
                    >
                        Szczegóły rezerwacji
                    </GuacamoleButton>
                    <GuacamoleFragileButton
                        sx={{ width: "50%" }}
                        onClick={() => console.log("usuń")}
                        disabled={!selectedReservation}
                    >
                        usuń rezerwacje
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
