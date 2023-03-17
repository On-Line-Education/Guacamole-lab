import React, { useState } from "react";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./classroomlist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import useDeleteClassroom from "../../hooks/useDeleteClassroom";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function ClassroomList({
    setClassroomAdditionPanelState,
    classroomList,
    loading,
    setSelectedClassroom,
    selectedClassroom,
    refetch,
}) {
    // Delete classroom hook declaration

    const { error, deleteClassroom } = useDeleteClassroom(selectedClassroom.id);

    // Headers for react-table

    const tableColumns = [
        {
            Header: "Id",
            accessor: "id",
        },
        {
            Header: "Sale",
            accessor: "name",
        },
    ];

    // Sleep function

    const timeout = (delay) => {
        return new Promise((res) => setTimeout(res, delay));
    };

    const openClassroomAdd = () => {
        setClassroomAdditionPanelState(true);
    };

    return (
        <div className="classroom-list-container">
            <div className="title classroom-list-title">Lista sal</div>
            <div className="classroom-list-panel">
                <div className="classroom-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <BasicTable
                            selectRow={setSelectedClassroom}
                            selectedRow={selectedClassroom}
                            tableColumns={tableColumns}
                            tableData={classroomList.classrooms}
                        />
                    )}
                </div>
                <div className="classroom-list-actions">
                    <GuacamoleButton
                        onClick={() => {
                            openClassroomAdd();
                        }}
                    >
                        Dodaj salę
                    </GuacamoleButton>
                    <GuacamoleFragileButton
                        disabled={selectedClassroom ? false : true}
                        onClick={async () => {
                            deleteClassroom();
                            // the timeout is needed becouse of the delay on server
                            await timeout(100);
                            refetch();
                        }}
                    >
                        Usuń salę
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
