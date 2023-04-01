import React, { useState, useEffect } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./instructorchangepassword.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useChangeInstructorsPassword from "../../hooks/useChangeInstructorsPassword";

export default function InstructorChangePassword({
    selectedInstructor,
    setInstructorChangePasswordPanelState,
    refetch,
}) {
    // Form field state

    const [newPassword, setNewPassword] = useState();

    // Edit Instructors Password hook declration

    const { data, changeInstructorsPassword } = useChangeInstructorsPassword(
        selectedInstructor ? selectedInstructor.id : undefined,
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
        setInstructorChangePasswordPanelState(false);
    };

    return (
        <>
            <div className="overlay"></div>
            <div className="instructor-password-change-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="instructor-password-change-panel">
                        <div className="panel-title">
                            Zmień hasło użytkownika: {selectedInstructor.name}
                        </div>
                        <div className="panel-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();

                                    changeInstructorsPassword();
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
