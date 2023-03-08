import React, { useState, useEffect } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./studentadd.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateStudent from "../../hooks/useCreateStudent";

export default function StudentAdd({ close, refetch }) {
    const [newStudentUsername, setNewStudentUsername] = useState();
    const [newStudentPassword, setNewStudentPassword] = useState();

    const [error, loading, createStudent] = useCreateStudent(
        newStudentUsername,
        newStudentPassword
    );

    useEffect(() => {
        refetch();
    }, [data]);

    if (error) {
        console.log(error);
    }

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
                                onSubmit={(e) => {
                                    e.preventDefault();
                                    createStudent();
                                    refetch();
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
