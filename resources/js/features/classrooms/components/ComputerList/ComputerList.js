import React from "react";
import { GuacamoleButton } from "../../../../mui";
import GuacamoleSoringTable from "../../../../components/SortingTable/SortingTable";
import "./computerlist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function ComputerList({
    openComputerAdd,
    openComputerDetails,
    computerList,
    loading,
    selectedClassroom,
    setSelectedComputer,
    selectedComputer,
}) {
    const tableColumns = [
        {
            Header: "ID",
            accessor: "id",
            disableSortBy: true,
        },
        {
            Header: "Nazwa",
            accessor: "name",
        },
        {
            Header: "IP",
            accessor: "ip",
            disableSortBy: true,
            Filter: true,
        },
    ];

    return (
        <div className="computer-list-container">
            <div className="title computer-list-title">
                Komputery w sali
                {selectedClassroom ? `: ${selectedClassroom.name}` : ""}
            </div>
            <div className="computer-list-panel">
                {selectedClassroom ? (
                    <>
                        <div className="computer-list">
                            {loading ? (
                                <LoadingSpinner />
                            ) : (
                                <BasicTable
                                    selectRow={setSelectedComputer}
                                    selectedRow={selectedComputer}
                                    tableData={computerList.computers}
                                    tableColumns={tableColumns}
                                />
                            )}
                        </div>
                        <div className="list-actions computer-list-actions">
                            <GuacamoleButton
                                sx={{ width: "40%" }}
                                onClick={() => openComputerAdd(true)}
                            >
                                Dodaj komputer
                            </GuacamoleButton>
                            <GuacamoleButton
                                sx={{ width: "50%" }}
                                onClick={() => openComputerDetails(true)}
                                disabled={selectedComputer ? false : true}
                            >
                                Szczegóły komputera
                            </GuacamoleButton>
                        </div>
                    </>
                ) : (
                    <>
                        <div className="computer-list">Wybierz salę</div>
                    </>
                )}
            </div>
        </div>
    );
}
