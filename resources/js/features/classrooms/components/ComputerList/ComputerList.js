import React from "react";
import { GuacamoleButton } from "../../../../mui";
import GuacamoleSoringTable from "../../../../components/SortingTable/SortingTable";
import "./computerlist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";

export default function ComputerList({
    openComputerAdd,
    openComputerDetails,
    computerList,
    loading,
    setSelectedComputer,
    selectedClassroom,
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
                        {loading ? (
                            "Loading"
                        ) : (
                            <BasicTable
                                selectRow={setSelectedComputer}
                                selectedRow={selectedComputer}
                                tableData={computerList.computers}
                                tableColumns={tableColumns}
                            />
                        )}
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
                        <div className="select-classroom-notice">
                            Wybierz salę
                        </div>
                    </>
                )}
            </div>
        </div>
    );
}
