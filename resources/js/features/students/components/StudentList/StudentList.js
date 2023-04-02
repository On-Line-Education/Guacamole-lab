import React, { useState } from "react";
import { GuacamoleButton } from "../../../../mui";
import "./studentlist.scss";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import SortingTable from "../../../../components/SortingTable/SortingTable";
import { useSelector } from "react-redux";

export default function StudentList({
    openStudentAdd,
    openStudentDetails,
    studentList,
    loading,
    selectedGroup,
    selectedStudent,
    setSelectedStudent,
    openStudentChangePasswordPanelState,
}) {
    const userRole = useSelector((state) => state.auth.role);
    // Collumns for react-table

    const tableColumns = [
        {
            Header: "Nazwa",
            name: "username",
            accessor: "username",
        },
    ];

    return (
        <div className="student-list-container">
            <div className="title student-list-title">Lista uczniów</div>
            <div className="student-list-panel">
                {selectedGroup ? (
                    <>
                        <div className="student-list">
                            {loading ? (
                                <LoadingSpinner />
                            ) : (
                                <SortingTable
                                    selectRow={setSelectedStudent}
                                    selectedRow={selectedStudent}
                                    tableData={
                                        studentList ? studentList.users : []
                                    }
                                    tableColumns={tableColumns}
                                    numbered={true}
                                />
                            )}
                        </div>
                        <div className="list-actions student-list-actions">
                            <GuacamoleButton
                                sx={{ width: "30%" }}
                                onClick={() => openStudentAdd(true)}
                            >
                                Dodaj ucznia
                            </GuacamoleButton>
                            <GuacamoleButton
                                sx={{ width: "30%" }}
                                onClick={() => openStudentDetails(true)}
                                disabled={!selectedStudent}
                            >
                                Szczegóły ucznia
                            </GuacamoleButton>
                            {userRole === "admin" ? (
                                <GuacamoleButton
                                    sx={{ width: "30%" }}
                                    onClick={() =>
                                        openStudentChangePasswordPanelState(
                                            true
                                        )
                                    }
                                    disabled={!selectedStudent}
                                >
                                    Zmień hasło
                                </GuacamoleButton>
                            ) : (
                                ""
                            )}
                        </div>
                    </>
                ) : (
                    <>
                        <div className="student-list">Wybierz grupę</div>
                    </>
                )}
            </div>
        </div>
    );
}
