import React, { useState, useEffect } from "react";
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
    const [newClassroomDescription, setNewClassroomDescription] = useState();

    // Create classroom hook declaration
    const { data, createClassroom } = useCreateClassroom(
        newClassroomName,
        newClassroomDescription
    );

    // Close panel function
    const close = () => {
        setClassroomAdditionPanelState(false);
    };

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (data.success) close();
        } catch {}
    }, [data]);

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
                        <div className="classroom-add-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();

                                    createClassroom();
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">Nazwa</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        required
                                        onChange={(e) =>
                                            setNewClassroomName(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">Opis</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        onChange={(e) =>
                                            setNewClassroomDescription(
                                                e.target.value
                                            )
                                        }
                                    />
                                </div>
                                <div className="panel-actions">
                                    <GuacamoleButton type="submit">
                                        Dodaj
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
