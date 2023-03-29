import React, { useEffect } from "react";
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
    refetch,
}) {
    // Delete Group hook declration
    const { data, deleteGroup } = useDeleteGroup(selectedGroup.id);

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (data.success) close();
        } catch {}
    }, [data]);

    // Collums for react-table
    const tableColumns = [
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
                            numbered={true}
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
                        onClick={() => {
                            deleteGroup();
                            refetch();
                        }}
                    >
                        Usuń grupę
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
