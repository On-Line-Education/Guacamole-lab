import React, { useState } from "react";
import { GuacamoleButton } from "../../../../mui";
import GuacamoleSoringTable from "../../../../components/SortingTable/SortingTable";
import "./studentlist.scss";

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
            accessor: "id",
            disableSortBy: true,
        },
        {
            Header: "Nazwa",
            accessor: "username",
        },
        {
            Header: "Grupy",
            accessor: "password",
            disableSortBy: true,
            Filter: true,
        },
    ];

    return (
        <div className="student-list-container">
            <div className="title student-list-title">Lista uczniów</div>
            <div className="student-list-panel">
                {loading ? (
                    "Loading"
                ) : (
                    <GuacamoleSoringTable
                        selectRow={setSelectedStudent}
                        selectedRow={selectedStudent}
                        tableData={studentList}
                        tableColumns={tableColumns}
                    />
                )}
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
                        disabled={selectedStudent ? false : true}
                    >
                        Szczegóły ucznia
                    </GuacamoleButton>
                </div>
            </div>
        </div>
    );
}
