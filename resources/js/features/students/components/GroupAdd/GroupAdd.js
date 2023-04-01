import React, { useEffect, useState } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./groupadd.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateGroup from "../../hooks/useCreateGroup";

export default function GroupAdd({ close, refetch }) {
    // Form field state
    const [newGroupName, setNewGroupName] = useState();

    // Create Group hook declration
    const { data, createGroup } = useCreateGroup(newGroupName);

    // Refetch logic
    useEffect(() => {
        try {
            if (data.success) {
                refetch();
                close();
            }
        } catch (e) {}
    }, [data]);

    return (
        <>
            <div className="overlay"></div>
            <div className="group-add-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="group-add-panel">
                        <div className="panel-title">Dodaj nową grupę</div>
                        <div className="panel-close">
                            <IconButton onClick={() => close(false)}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                        <div className="panel-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();

                                    createGroup();
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">Nazwa</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        size="small"
                                        required
                                        onChange={(e) =>
                                            setNewGroupName(e.target.value)
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
