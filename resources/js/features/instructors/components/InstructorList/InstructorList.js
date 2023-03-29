import React, { useEffect } from "react";
import { GuacamoleFragileButton } from "../../../../mui";
import "./instructorlist.scss";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import SortingTable from "../../../../components/SortingTable/SortingTable";
import useDeleteInstructor from "../../hooks/useDeleteInstructor";

export default function InstructorList({
    instructorList,
    loading,
    setSelectedInstructor,
    selectedInstructor,
    refetch,
}) {
    // Collumns for react-table

    const tableColumns = [
        {
            Header: "Nazwa",
            name: "username",
            accessor: "username",
        },
    ];

    // Delete Instructor hook declarataion
    const { data: deleteInstructorData, deleteInstructor } =
        useDeleteInstructor(
            selectedInstructor ? selectedInstructor.id : undefined
        );

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (deleteInstructorData.success) close();
        } catch {}
    }, [deleteInstructorData]);

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
                            numbered={true}
                        />
                    )}
                </div>
                <div className="list-actions instructor-list-actions">
                    <GuacamoleFragileButton
                        sx={{ width: "100%" }}
                        onClick={() => deleteInstructor()}
                    >
                        Usuń nauczyciela
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
