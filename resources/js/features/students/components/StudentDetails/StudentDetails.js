import React, { useState } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./studentdetails.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import { GuacamoleFragileButton } from "../../../../mui";

export default function StudentDetails({ close }) {
    const [newStudentUsername, setNewStudentUsername] = useState();
    const [newStudentPassword, setNewStudentPassword] = useState();

    const [selectedRow, setSelectedRow] = useState(null);

    const MOCKDATA = {
        DATA: [
            {
                id: 1,
                computerName: "ewelford0",
                ip: "80.202.29.109",
            },
            {
                id: 2,
                computerName: "klelievre1",
                ip: "97.36.250.129",
            },
            {
                id: 3,
                computerName: "emccray2",
                ip: "240.36.9.93",
            },
            {
                id: 4,
                computerName: "mtotman3",
                ip: "97.60.49.9",
            },
            {
                id: 5,
                computerName: "mhalsted4",
                ip: "180.73.249.113",
            },
            {
                id: 6,
                computerName: "rdecort5",
                ip: "146.72.121.180",
            },
            {
                id: 7,
                computerName: "yjuris6",
                ip: "49.62.172.19",
            },
            {
                id: 8,
                computerName: "jfantone7",
                ip: "252.93.90.128",
            },
            {
                id: 9,
                computerName: "ekleinstub8",
                ip: "40.81.140.86",
            },
            {
                id: 10,
                computerName: "racland9",
                ip: "50.164.98.74",
            },
            {
                id: 11,
                computerName: "mclixbya",
                ip: "52.186.193.221",
            },
            {
                id: 12,
                computerName: "sgarfirthb",
                ip: "218.122.98.55",
            },
            {
                id: 13,
                computerName: "mollandc",
                ip: "8.164.205.48",
            },
            {
                id: 14,
                computerName: "ubanfieldd",
                ip: "108.130.66.84",
            },
            {
                id: 15,
                computerName: "gdumelowe",
                ip: "129.199.193.79",
            },
        ],
        COLUMNS: [
            {
                Header: "Id",
                accessor: "id",
            },
            {
                Header: "Computer",
                accessor: "computerName",
            },
            {
                Header: "IP",
                accessor: "ip",
            },
        ],
    };

    return (
        <>
            <div className="overlay"></div>
            <div className="student-details-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="student-details-panel">
                        <div className="panel-info">
                            <div className="user-info" id="groups">
                                Nazwa:
                            </div>
                            <div className="user-info" id="groups">
                                Grupy:
                            </div>
                        </div>
                        <div className="panel-list-container">
                            <UserAccessList
                                selectedRow={selectedRow}
                                setSelectedRow={setSelectedRow}
                                MOCKDATA={MOCKDATA}
                            />
                        </div>
                        <div className="panel-close">
                            <IconButton onClick={() => close(false)}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                    </div>
                </ClickAwayListener>
            </div>
        </>
    );
}

function UserAccessList({ MOCKDATA, selectedRow, setSelectedRow }) {
    return (
        <>
            <div className="panel-list-title">
                Lista komputerów, do których uczeń ma dostęp
            </div>
            <div className="panel-list computer-access-list">
                <BasicTable
                    selectRow={setSelectedRow}
                    selectedRow={selectedRow}
                    MOCKDATA={MOCKDATA}
                />
                <div className="list-actions computer-access-list-actions">
                    <GuacamoleFragileButton
                        sx={{ width: "40%" }}
                        onClick={() => console.log("?")}
                    >
                        Usuń dostęp
                    </GuacamoleFragileButton>
                </div>
            </div>
        </>
    );
}
