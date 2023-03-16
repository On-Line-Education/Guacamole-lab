import React, { useState } from "react";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./classroomlist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import useDeleteClassroom from "../../hooks/useDeleteClassroom";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function ClassroomList({
    openClassroomAdd,
    classroomList,
    loading,
    setSelectedClassroom,
    selectedClassroom,
}) {
    const { error: classroomDeletionError, deleteClassroom } =
        useDeleteClassroom(selectedClassroom.id);

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
                            openClassroomAdd(true);
                        }}
                    >
                        Dodaj salę
                    </GuacamoleButton>
                    <GuacamoleFragileButton
                        disabled={selectedClassroom ? false : true}
                        onClick={() => deleteClassroom()}
                    >
                        Usuń salę
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
