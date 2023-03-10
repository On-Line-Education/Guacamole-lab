import React, { useState } from "react";
import { GuacamoleButton } from "../../../../mui";
import GuacamoleSoringTable from "../../../../components/SortingTable/SortingTable";
import "./studentlist.scss";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

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
            accessor: "group",
            disableSortBy: true,
            Filter: true,
        },
    ];

    return (
        <div className="student-list-container">
            <div className="title student-list-title">Lista uczniów</div>
            <div className="student-list-panel">
                <div className="student-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <GuacamoleSoringTable
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
                        disabled={selectedStudent ? false : true}
                    >
                        Szczegóły ucznia
                    </GuacamoleButton>
                </div>
            </div>
        </div>
    );
}
