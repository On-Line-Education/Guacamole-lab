import React, { useState } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./classroomadd.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateClassroom from "../../hooks/useCreateClassroom";

export default function ClassroomAdd({
    refetch,
    setClassroomAdditionPanelState,
}) {
    // Form fields state

    const [newClassroomName, setNewClassroomName] = useState();

    // Create classroom hook declaration

    const [error, loading, createClassroom] = useCreateClassroom(
        newClassroomName,
        "desc"
    );

    const close = () => {
        setClassroomAdditionPanelState(false);
    };

    return (
        <>
            <div className="overlay"></div>
            <div className="classroom-add-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="classroom-add-panel">
                        <div className="panel-title">Stwórz nową salę</div>
                        <div className="panel-close">
                            <IconButton onClick={() => close()}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                        <div className="panel-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();

                                    createClassroom();
                                    refetch();
                                    close();
                                }}
                            >
                                <div className="form-classroom">
                                    <label className="form-label">Nazwa</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        variant="outlined"
                                        size="small"
                                        id="classroom-name"
                                        onChange={(e) =>
                                            setNewClassroomName(e.target.value)
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
