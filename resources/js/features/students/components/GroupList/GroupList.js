import React, { useState } from "react";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./grouplist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import useDeleteGroup from "../../hooks/useDeleteGroup";

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

    if (loading) return "Loading...";

    return (
        <div className="group-list-container">
            <div className="title group-list-title">Lista grup</div>
            <div className="group-list-panel">
                <div className="group-list">
                    <BasicTable
                        selectRow={setSelectedGroup}
                        selectedRow={selectedGroup}
                        tableColumns={tableColumns}
                        tableData={groupList.class}
                    />
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
