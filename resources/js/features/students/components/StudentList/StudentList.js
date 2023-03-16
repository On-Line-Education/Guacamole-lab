import React, { useState } from "react";
import { GuacamoleButton } from "../../../../mui";
import "./studentlist.scss";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import SortingTable from "../../../../components/SortingTable/SortingTable";

export default function StudentList({
    openStudentAdd,
    openStudentDetails,
    studentList,
    loading,
    setSelectedStudent,
    selectedStudent,
}) {
    const tableColumns = [
        {
            Header: "ID",
            name: "id",
            accessor: "id",
            disableSortBy: true,
        },
        {
            Header: "Nazwa",
            name: "username",
            accessor: "username",
        },
        {
            Header: "Grupy",
            name: "group",
            accessor: "classes",
            destructureClass: true,
            disableSortBy: true,
            Filter: true,
        },
    ];

    console.log(studentList);

    return (
        <div className="student-list-container">
            <div className="title student-list-title">Lista uczniów</div>
            <div className="student-list-panel">
                <div className="student-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <SortingTable
                            selectRow={setSelectedStudent}
                            selectedRow={selectedStudent}
                            tableData={studentList}
                            tableColumns={tableColumns}
                        />
                    )}
                </div>
                <div className="list-actions student-list-actions">
                    <GuacamoleButton
                        sx={{ width: "40%" }}
                        onClick={() => openStudentAdd(true)}
                    >
                        Dodaj ucznia
                    </GuacamoleButton>
                    <GuacamoleButton
                        sx={{ width: "50%" }}
                        onClick={() => openStudentDetails(true)}
                        disabled={!selectedStudent}
                    >
                        Szczegóły ucznia
                    </GuacamoleButton>
                </div>
            </div>
        </div>
    );
}
