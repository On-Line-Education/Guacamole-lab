import React, { useState, useEffect } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./studentchangepassword.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useChangeStudentsPassword from "../../hooks/useChangeStudentsPassword";

export default function StudentChangePassword({
    selectedStudent,
    setStudentChangePasswordPanelState,
    refetch,
}) {
    // Form field state

    const [newPassword, setNewPassword] = useState();

    // Edit Instructors Password hook declration

    const { data, changeStudentsPassword } = useChangeStudentsPassword(
        selectedStudent ? selectedStudent.id : undefined,
        newPassword
    );

    // Refetch logic

    useEffect(() => {
        try {
            if (data.success) {
                refetch();
                close();
            }
        } catch (e) {}
    }, [data]);

    // close panel function

    const close = () => {
        setStudentChangePasswordPanelState(false);
    };

    return (
        <>
            <div className="overlay"></div>
            <div className="student-password-change-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="student-password-change-panel">
                        <div className="panel-title">
                            Zmień hasło użytkownika: {selectedStudent.name}
                        </div>
                        <div className="panel-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();

                                    changeStudentsPassword();
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">
                                        Nowe Hasło
                                    </label>
                                    <GuacamoleInput
                                        className="form-input"
                                        size="small"
                                        required
                                        onChange={(e) =>
                                            setNewPassword(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="panel-actions">
                                    <GuacamoleButton type="submit">
                                        Zmień
                                    </GuacamoleButton>
                                </div>
                            </form>
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
