import React, { useState } from "react";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import "./grouplist.scss";
import BasicTable from "../../../../components/BasicTable/BasicTable";

export default function GroupList({ openStudentAdd }) {
    const [selectedRow, setSelectedRow] = useState(null);

    console.log(selectedRow);

    // TESTING DATA

    const MOCKDATA = {
        DATA: [
            {
                id: 1,
                group: "1tc",
            },
            {
                id: 2,
                group: "4la",
            },
            {
                id: 3,
                group: "4ta",
            },
            {
                id: 4,
                group: "1gtb",
            },
            {
                id: 5,
                group: "1gtb",
            },
            {
                id: 6,
                group: "1tc",
            },
            {
                id: 7,
                group: "4la",
            },
            {
                id: 8,
                group: "1gta",
            },
            {
                id: 9,
                group: "1gta",
            },
            {
                id: 10,
                group: "1tc",
            },
            {
                id: 10,
                group: "1tc",
            },
        ],
        COLUMNS: [
            {
                Header: "Id",
                accessor: "id",
            },

            {
                Header: "Groups",
                accessor: "group",
            },
        ],
    };

    return (
        <div className="group-list-container">
            <div className="title group-list-title">Lista grup</div>
            <div className="group-list-panel">
                <div className="group-list">
                    <BasicTable
                        selectRow={setSelectedRow}
                        selectedRow={selectedRow}
                        MOCKDATA={MOCKDATA}
                    />
                </div>
                <div className="group-list-actions">
                    <GuacamoleButton>Dodaj grupę</GuacamoleButton>
                    <GuacamoleFragileButton>Usuń grupę</GuacamoleFragileButton>
                </div>
            </div>
        </div>
    );
}
