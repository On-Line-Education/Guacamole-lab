import React, { useState } from "react";
import { GuacamoleFragileButton } from "../../../../mui";
import "./instructorlist.scss";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import SortingTable from "../../../../components/SortingTable/SortingTable";

export default function InstructorList({
    instructorList,
    loading,
    setSelectedInstructor,
    selectedInstructor,
}) {
    // Collumns for react-table

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
    ];

    return (
        <div className="instructor-list-container">
            <div className="title instructor-list-title">Lista nauczycieli</div>
            <div className="instructor-list-panel">
                <div className="instructor-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <SortingTable
                            selectRow={setSelectedInstructor}
                            selectedRow={selectedInstructor}
                            tableData={instructorList}
                            tableColumns={tableColumns}
                        />
                    )}
                </div>
                <div className="list-actions instructor-list-actions">
                    <GuacamoleFragileButton sx={{ width: "100%" }}>
                        Usuń nauczyciela
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
