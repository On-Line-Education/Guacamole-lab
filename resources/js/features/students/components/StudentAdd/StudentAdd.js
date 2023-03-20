import React, { useState, useEffect } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./studentadd.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateStudent from "../../hooks/useCreateStudent";
import useAssignToGroup from "../../hooks/useAssignToGroup";

export default function StudentAdd({ group, close, refetch }) {
    // Form fields state
    const [newStudentUsername, setNewStudentUsername] = useState();
    const [newStudentPassword, setNewStudentPassword] = useState();

    // Create Student hook declaration
    const { data: createStudentData, createStudent } = useCreateStudent(
        newStudentUsername,
        newStudentPassword,
        group
    );

    const [userId, setUserId] = useState();

    // Auto-assign to group logic

    const { data: assignToGroupData, assignToGroup } = useAssignToGroup(
        group.id,
        userId
    );

    useEffect(() => {
        try {
            if (createStudentData.success) {
                setUserId(createStudentData.body.user.id);
            }
        } catch {}
    }, [createStudentData]);

    useEffect(() => {
        if (userId) {
            assignToGroup();
        }
    }, [userId]);

    // Refetch logic
    useEffect(() => {
        try {
            if (
                createStudentData.success &&
                typeof assignToGroupData === "undefined"
            ) {
                refetch();
                close();
            }
        } catch (e) {}
    }, [createStudentData, assignToGroupData]);

    return (
        <>
            <div className="overlay"></div>
            <div className="student-add-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="student-add-panel">
                        <div className="panel-title">Stwórz nowego ucznia</div>
                        <div className="panel-close">
                            <IconButton onClick={() => close(false)}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                        <div className="panel-form">
                            <form
                                onSubmit={async (e) => {
                                    e.preventDefault();
                                    createStudent();
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">Nazwa</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        variant="outlined"
                                        size="small"
                                        id="username"
                                        onChange={(e) =>
                                            setNewStudentUsername(
                                                e.target.value
                                            )
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">Hasło</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        variant="outlined"
                                        type="password"
                                        size="small"
                                        id="password"
                                        onChange={(e) =>
                                            setNewStudentPassword(
                                                e.target.value
                                            )
                                        }
                                    />
                                </div>
                                <div className="panel-actions">
                                    <GuacamoleButton type="submit">
                                        Stwórz
                                    </GuacamoleButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </ClickAwayListener>
            </div>
        </>
    );
}
