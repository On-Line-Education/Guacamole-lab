import React, { useState } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./computerdetails.scss";
import { IconButton, TextField } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import useDeleteComputer from "../../hooks/useDeleteComputer";
import EditIcon from "@mui/icons-material/Edit";
import EditOffIcon from "@mui/icons-material/EditOff";

export default function ComputerDetails({ classroom, computer, close }) {
    const [nameEditActive, setNameEditActive] = useState(false);
    const [ipEditActive, setIpEditActive] = useState(false);
    const [macEditActive, setMacEditActive] = useState(false);

    const [newName, setNewName] = useState("");
    const [newIp, setNewIp] = useState("");
    const [newMac, setNewMac] = useState("");

    const { error, deleteComputer } = useDeleteComputer(
        classroom.id,
        computer.id
    );

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
                                            Sala:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-classroom"
                                        >
                                            {classroom.name}
                                        </td>
                                    </tr>
                                    <tr className="computer-info-group">
                                        <td className="computer-info-key">
                                            Nazwa:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-name"
                                        >
                                            {nameEditActive ? (
                                                <TextField
                                                    variant="standard"
                                                    placeholder={computer.name}
                                                    onChange={(e) => {
                                                        setNewName(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                            ) : (
                                                computer.name
                                            )}
                                        </td>
                                        <td className="computer-info-edit">
                                            <IconButton
                                                size="small"
                                                color="primary"
                                                onClick={() => {
                                                    setNewName("");
                                                    setNameEditActive(
                                                        !nameEditActive
                                                    );
                                                }}
                                            >
                                                {nameEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </td>
                                    </tr>
                                    <tr className="computer-info-group">
                                        <td className="computer-info-key">
                                            IP:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-ip"
                                        >
                                            {ipEditActive ? (
                                                <TextField
                                                    variant="standard"
                                                    placeholder={computer.ip}
                                                    onChange={(e) => {
                                                        setNewIp(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                            ) : (
                                                computer.ip
                                            )}
                                        </td>
                                        <td className="computer-info-edit">
                                            <IconButton
                                                size="small"
                                                color="primary"
                                                onClick={() => {
                                                    setIpEditActive(
                                                        !ipEditActive
                                                    );
                                                }}
                                            >
                                                {ipEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </td>
                                    </tr>
                                    <tr className="computer-info-group">
                                        <td className="computer-info-key">
                                            MAC:
                                        </td>
                                        <td
                                            className="computer-info-value"
                                            id="computer-mac"
                                        >
                                            {macEditActive ? (
                                                <TextField
                                                    variant="standard"
                                                    placeholder={computer.mac}
                                                    onChange={(e) => {
                                                        setNewMac(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                            ) : (
                                                computer.mac
                                            )}
                                        </td>
                                        <td className="computer-info-edit">
                                            <IconButton
                                                size="small"
                                                color="primary"
                                                onClick={() => {
                                                    setMacEditActive(
                                                        !macEditActive
                                                    );
                                                }}
                                            >
                                                {macEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="panel-actions">
                            <GuacamoleFragileButton
                                sx={{ width: "45%" }}
                                onClick={() => deleteComputer()}
                            >
                                Usuń ucznia
                            </GuacamoleFragileButton>
                            <GuacamoleButton
                                sx={{ width: "45%" }}
                                disabled={!newName && !newIp && !newMac}
                            >
                                Edytuj dane
                            </GuacamoleButton>
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
