import React, { useState, useEffect } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./studentdetails.scss";
import { IconButton, TextField } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import { GuacamoleButton, GuacamoleFragileButton } from "../../../../mui";
import GroupTile from "../GroupTile/GroupTile";
import useDeleteStudent from "../../hooks/useDeleteStudent";
import EditIcon from "@mui/icons-material/Edit";
import EditOffIcon from "@mui/icons-material/EditOff";
import useEditStudent from "../../hooks/useEditStudent";

export default function StudentDetails({ student, refetch, close }) {
    // Destructurize student object
    const { username, classes } = student;

    // Form Fields State
    const [usernameEditActive, setUsernameEditActive] = useState(false);
    const [newUsername, setNewUsername] = useState("");

    // Delete Student hook declaration
    const { data: deleteStudentData, deleteStudent } = useDeleteStudent(
        student.id
    );

    // Edit Student hook declaration
    const { data: editStudentData, editStudent } = useEditStudent(
        student.id,
        newUsername
    );

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (deleteStudentData.success) close();
        } catch {}
    }, [deleteStudentData]);

    useEffect(() => {
        try {
            refetch();
            if (editStudentData.success) close();
        } catch {}
    }, [editStudentData]);

    return (
        <>
            <div className="overlay"></div>
            <div className="student-details-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="student-details-panel">
                        <div className="panel-info">
                            <table className="student-info-panel">
                                <tbody>
                                    <tr className="student-info-group">
                                        <td className="student-info-key">
                                            Nazwa:
                                        </td>

                                        <td
                                            className="student-info-value"
                                            id="username"
                                        >
                                            {usernameEditActive ? (
                                                <TextField
                                                    variant="standard"
                                                    placeholder={username}
                                                    onChange={(e) => {
                                                        setNewUsername(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                            ) : (
                                                username
                                            )}
                                        </td>
                                        <td className="computer-info-edit">
                                            <IconButton
                                                size="small"
                                                color="primary"
                                                onClick={() => {
                                                    setNewUsername("");
                                                    setUsernameEditActive(
                                                        !usernameEditActive
                                                    );
                                                }}
                                            >
                                                {usernameEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </td>
                                    </tr>
                                    <tr className="student-info-group">
                                        <td className="student-info-key">
                                            Grupy:
                                        </td>

                                        <td
                                            className="student-info-value"
                                            id="groups"
                                        >
                                            {classes.map((group) => {
                                                return (
                                                    <GroupTile
                                                        key={group.id}
                                                        className={group.name}
                                                        classId={group.id}
                                                        userId={student.id}
                                                    />
                                                );
                                            })}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="panel-actions">
                            <GuacamoleFragileButton
                                sx={{ width: "45%" }}
                                onClick={() => deleteStudent()}
                            >
                                Usuń ucznia
                            </GuacamoleFragileButton>
                            <GuacamoleButton
                                sx={{ width: "45%" }}
                                disabled={!newUsername}
                                onClick={() => editStudent()}
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
