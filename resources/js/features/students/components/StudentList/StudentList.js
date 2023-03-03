import React, { useState } from "react";
import { GuacamoleButton } from "../../../../mui";
import GuacamoleSoringTable from "../../../../components/SortingTable/SortingTable";
import "./studentlist.scss";

export default function StudentList({ openStudentAdd, openStudentDetails }) {
    const [selectedRow, setSelectedRow] = useState(null);

    console.log(selectedRow);

    return (
        <div className="student-list-container">
            <div className="title student-list-title">Lista uczniów</div>
            <div className="student-list-panel">
                <GuacamoleSoringTable
                    selectRow={setSelectedRow}
                    selectedRow={selectedRow}
                />
                <div className="list-actions student-list-actions">
                    <GuacamoleButton
                        sx={{ width: "40%" }}
                        onClick={() => openStudentAdd(true)}
                    >
                        Dodaj ucznia
                    </GuacamoleButton>
                    <GuacamoleButton
                        sx={{ width: "50%" }}
                        onClick={() => openStudentDetails(true)}
                    >
                        Szczegóły ucznia
                    </GuacamoleButton>
                </div>
            </div>
        </div>
    );
}
