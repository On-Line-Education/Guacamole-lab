import React, { useState, useEffect } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./computerdetails.scss";
import { Checkbox, IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import {
    GuacamoleButton,
    GuacamoleFragileButton,
    GuacamoleInput,
} from "../../../../mui";
import useDeleteComputer from "../../hooks/useDeleteComputer";
import EditIcon from "@mui/icons-material/Edit";
import EditOffIcon from "@mui/icons-material/EditOff";
import useEditComputer from "../../hooks/useEditComputer";

export default function ComputerDetails({
    classroom,
    computer,
    refetch,
    setComputerDetailsPanelState,
}) {
    // Form edit state

    const [nameEditActive, setNameEditActive] = useState(false);
    const [ipEditActive, setIpEditActive] = useState(false);
    const [macEditActive, setMacEditActive] = useState(false);
    const [instructorEditActive, setInstructorEditActive] = useState(false);

    // Form fields state
    const [newName, setNewName] = useState("");
    const [newIp, setNewIp] = useState("");
    const [newMac, setNewMac] = useState("");
    const [newInstructor, setNewInstructor] = useState("");

    // Close panel function

    const close = () => {
        setComputerDetailsPanelState(false);
    };

    // Delete Computer hook declarataion
    const { data: deleteComputerData, deleteComputer } = useDeleteComputer(
        classroom.id,
        computer.id
    );

    // Edit Computer hook declarataion
    const { data: editComputerData, editComputer } = useEditComputer(
        classroom.id,
        computer.id,
        {
            name: newName ? newName : undefined,
            ip: newIp ? newIp : undefined,
            mac: newMac ? newMac : undefined,
            instructor: newInstructor ? newInstructor : undefined,
        }
    );

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (editComputerData.success) close();
        } catch {}
    }, [editComputerData]);

    useEffect(() => {
        try {
            refetch();
            if (deleteComputerData.success) close();
        } catch {}
    }, [deleteComputerData]);

    return (
        <>
            <div className="overlay"></div>
            <div className="computer-details-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="computer-details-panel">
                        <div className="computer-details">
                            {/* Computer Classroom  */}
                            <div className="detail-group">
                                <label className="detail-label">Sala</label>
                                <div className="detail-container">
                                    <div className={`detail`}>
                                        <GuacamoleInput
                                            placeholder={classroom.name}
                                            InputProps={{
                                                readOnly: true,
                                            }}
                                        />
                                    </div>
                                </div>
                            </div>
                            {/* Computer Name  */}
                            <div className="detail-group">
                                <label className="detail-label">Nazwa</label>
                                <div className="detail-container">
                                    <div
                                        className={`detail ${
                                            nameEditActive ? "edit" : ""
                                        }`}
                                    >
                                        <GuacamoleInput
                                            placeholder={computer.name}
                                            InputProps={{
                                                readOnly: !nameEditActive,
                                            }}
                                            value={newName}
                                            onChange={(e) => {
                                                setNewName(e.target.value);
                                            }}
                                        />
                                    </div>
                                    <div className="detail-edit">
                                        <IconButton
                                            size="small"
                                            onClick={() => {
                                                setNameEditActive(
                                                    !nameEditActive
                                                );
                                                setNewName("");
                                            }}
                                        >
                                            {nameEditActive ? (
                                                <EditOffIcon />
                                            ) : (
                                                <EditIcon />
                                            )}
                                        </IconButton>
                                    </div>
                                </div>
                            </div>
                            {/* Computer MAC  */}
                            <div className="detail-group">
                                <label className="detail-label">MAC</label>
                                <div className="detail-container">
                                    <div
                                        className={`detail ${
                                            macEditActive ? "edit" : ""
                                        }`}
                                    >
                                        <GuacamoleInput
                                            placeholder={
                                                computer.mac
                                                    ? computer.mac
                                                    : "brak adresu"
                                            }
                                            InputProps={{
                                                readOnly: !macEditActive,
                                            }}
                                            value={newMac}
                                            onChange={(e) => {
                                                setNewMac(e.target.value);
                                            }}
                                        />
                                    </div>
                                    <div className="detail-edit">
                                        <IconButton
                                            size="small"
                                            onClick={() => {
                                                setMacEditActive(
                                                    !macEditActive
                                                );
                                                setNewMac("");
                                            }}
                                        >
                                            {macEditActive ? (
                                                <EditOffIcon />
                                            ) : (
                                                <EditIcon />
                                            )}
                                        </IconButton>
                                    </div>
                                </div>
                            </div>
                            {/* Computer IP  */}
                            <div className="detail-group">
                                <label className="detail-label">IP</label>
                                <div className="detail-container">
                                    <div
                                        className={`detail ${
                                            ipEditActive ? "edit" : ""
                                        }`}
                                    >
                                        <GuacamoleInput
                                            placeholder={computer.ip}
                                            InputProps={{
                                                readOnly: !ipEditActive,
                                            }}
                                            value={newIp}
                                            onChange={(e) => {
                                                setNewIp(e.target.value);
                                            }}
                                        />
                                    </div>
                                    <div className="detail-edit">
                                        <IconButton
                                            size="small"
                                            onClick={() => {
                                                setIpEditActive(!ipEditActive);
                                                setNewIp("");
                                            }}
                                        >
                                            {ipEditActive ? (
                                                <EditOffIcon />
                                            ) : (
                                                <EditIcon />
                                            )}
                                        </IconButton>
                                    </div>
                                </div>
                            </div>
                            {/* Computer Instructor  */}
                            <div className="detail-group">
                                <label className="detail-label">
                                    Komputer instruktorski
                                </label>
                                <div className="detail-container">
                                    <div className="detail">
                                        <Checkbox
                                            defaultChecked={Boolean(
                                                computer.instructor
                                            )}
                                            disabled={!instructorEditActive}
                                            onChange={(e) =>
                                                setNewInstructor(
                                                    e.target.checked
                                                )
                                            }
                                        />
                                    </div>
                                    <div className="detail-edit">
                                        <IconButton
                                            size="small"
                                            onClick={() => {
                                                setInstructorEditActive(
                                                    !instructorEditActive
                                                );
                                                setNewInstructor("");
                                            }}
                                        >
                                            {instructorEditActive ? (
                                                <EditOffIcon />
                                            ) : (
                                                <EditIcon />
                                            )}
                                        </IconButton>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="panel-actions">
                            <GuacamoleFragileButton
                                sx={{ width: "45%" }}
                                onClick={() => deleteComputer()}
                            >
                                Usuń komputer
                            </GuacamoleFragileButton>
                            <GuacamoleButton
                                sx={{ width: "45%" }}
                                disabled={
                                    !newName &&
                                    !newIp &&
                                    !newMac &&
                                    !newInstructor
                                }
                                onClick={async () => {
                                    {
                                        editComputer();
                                    }
                                }}
                            >
                                Zapisz
                            </GuacamoleButton>
                        </div>
                        <div className="panel-close">
                            <IconButton onClick={() => close()}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                    </div>
                </ClickAwayListener>
            </div>
        </>
    );
}
