import React, { useState } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./computerdetails.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import BasicTable from "../../../../components/BasicTable/BasicTable";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import useDeleteComputer from "../../hooks/useDeleteComputer";

export default function ComputerDetails({ classroom, computer, close }) {
    const [selectedRow, setSelectedRow] = useState(null);

    const { error, deleteComputer } = useDeleteComputer(
        classroom.id,
        computer.id
    );

    const DATA = [
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
    ];

    const COLUMNS = [
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
    ];

    return (
        <>
            <div className="overlay"></div>
            <div className="computer-details-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="computer-details-panel">
                        <div className="panel-info">
                            <table className="computer-info-panel">
                                <tbody>
                                    <tr className="computer-info-group">
                                        <td className="computer-info-key">
                                            Nazwa:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-name"
                                        >
                                            {computer.name}
                                        </td>
                                        <td className="computer-info-key">
                                            IP:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-ip"
                                        >
                                            {computer.ip}
                                        </td>
                                    </tr>
                                    <tr className="computer-info-group">
                                        <td className="computer-info-key">
                                            Sala:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-classroom"
                                        >
                                            {classroom.name}
                                        </td>
                                        <td className="computer-info-key">
                                            MAC:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-mac"
                                        >
                                            {computer.mac}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="panel-list-container">
                            <ClassroomAccessList
                                selectedRow={selectedRow}
                                setSelectedRow={setSelectedRow}
                                tableColumns={COLUMNS}
                                tableData={DATA}
                            />
                        </div>
                        <div className="panel-additional-actions">
                            <div
                                className="panel-action"
                                id="delete-computer"
                                onClick={() => deleteComputer()}
                            >
                                Usuń ten komputer
                            </div>
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

function ClassroomAccessList({
    tableColumns,
    tableData,
    selectedRow,
    setSelectedRow,
}) {
    return (
        <>
            <div className="panel-list-title">Lista uczniów z dostępem</div>
            <div className="panel-list computer-access-list">
                <BasicTable
                    selectRow={setSelectedRow}
                    selectedRow={selectedRow}
                    tableColumns={tableColumns}
                    tableData={tableData}
                />
                <div className="list-actions computer-access-list-actions">
                    <GuacamoleButton
                        sx={{ width: "40%" }}
                        onClick={() => console.log("?")}
                    >
                        Dodaj dostęp
                    </GuacamoleButton>
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
