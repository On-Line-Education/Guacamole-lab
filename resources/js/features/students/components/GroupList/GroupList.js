import React, { useState } from "react";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./grouplist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import useDeleteGroup from "../../hooks/useDeleteGroup";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function GroupList({
    openGroupAdd,
    groupList,
    loading,
    setSelectedGroup,
    selectedGroup,
}) {
    const { error: groupDeletionError, deleteGroup } = useDeleteGroup(
        selectedGroup.id
    );

    const tableColumns = [
        {
            Header: "Id",
            accessor: "id",
        },
        {
            Header: "Grupa",
            accessor: "name",
        },
    ];

    return (
        <div className="group-list-container">
            <div className="title group-list-title">Lista grup</div>
            <div className="group-list-panel">
                <div className="group-list">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <BasicTable
                            selectRow={setSelectedGroup}
                            selectedRow={selectedGroup}
                            tableColumns={tableColumns}
                            tableData={groupList.class}
                        />
                    )}
                </div>
                <div className="group-list-actions">
                    <GuacamoleButton
                        onClick={() => {
                            openGroupAdd(true);
                        }}
                    >
                        Dodaj grupę
                    </GuacamoleButton>
                    <GuacamoleFragileButton
                        disabled={selectedGroup ? false : true}
                        onClick={() => deleteGroup()}
                    >
                        Usuń grupę
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
