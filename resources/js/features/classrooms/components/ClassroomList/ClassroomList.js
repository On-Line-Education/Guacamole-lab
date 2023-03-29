import React, { useEffect } from "react";
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
    const { data, deleteClassroom } = useDeleteClassroom(selectedClassroom.id);

    // Open panel function
    const openClassroomAdd = () => {
        setClassroomAdditionPanelState(true);
    };

    // Refetch logic
    useEffect(() => {
        try {
            if (data.success) {
                refetch();
            }
        } catch (e) {}
    }, [data]);

    // Headers for react-table
    const tableColumns = [
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
                            numbered={true}
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
                        }}
                    >
                        Usuń salę
                    </GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
