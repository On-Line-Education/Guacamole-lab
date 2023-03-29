import React from "react";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import SortingTable from "../../../../components/SortingTable/SortingTable";
import "./userlessonlist.scss";

export default function UserLessonList({
    selectedSession,
    setSelectedSession,
    sessionList,
    loading,
    date,
}) {
    const tableColumns = [
        {
            Header: "Czas startu",
            name: "time",
            accessor: "start",
            disableSortBy: true,
            dateFormat: "DD-MM HH:mm",
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
        },
    ];

    return (
        <div className="user-lesson-list-container">
            <div className="title user-lesson-list-title">Twoje lekcje</div>
            <div className="user-lesson-list-panel">
                <div className="user-lesson-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <SortingTable
                            selectedRow={selectedSession}
                            selectRow={setSelectedSession}
                            tableData={sessionList.lectures}
                            tableColumns={tableColumns}
                            externalFilter={date.format("DD-MM")}
                        />
                    )}
                </div>
            </div>
        </div>
    );
}
