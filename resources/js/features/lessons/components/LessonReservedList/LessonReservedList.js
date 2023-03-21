import React, { useEffect } from "react";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./lessonreservedlist.scss";
import SortingTable from "../../../../components/SortingTable/SortingTable";
import useDeleteReservation from "../../hooks/useDeleteReservation";

export default function LessonReservedList({
    reservedList,
    loading,
    refetch,
    selectedReservation,
    setSelectedReservation,
    setReservationDetailsPanelState,
    date,
}) {
    // Table collumns for react-table

    const tableColumns = [
        {
            Header: "Start",
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
            disableSortBy: false,
        },
        {
            Header: "Sala",
            name: "classroom",
            accessor: "class_room.name",
            disableSortBy: false,
        },
        {
            Header: "Nazwa",
            name: "name",
            accessor: "name",
            disableSortBy: true,
            Filter: true,
        },
    ];

    // Delete Reservation hook declaration

    const { data: deleteReservationData, deleteReservation } =
        useDeleteReservation(selectedReservation.id);

    // Refetch logic
    useEffect(() => {
        try {
            if (deleteReservationData.success) {
                refetch();
            }
        } catch (e) {}
    }, [deleteReservationData]);

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
                            externalFilter={date.format("DD-MM")}
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
                        onClick={() => deleteReservation()}
                        disabled={!selectedReservation}
                    >
                        usuń rezerwacje
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
