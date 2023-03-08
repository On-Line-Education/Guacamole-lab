import React, { useEffect, useState } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./groupadd.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateGroup from "../../hooks/useCreateGroup";

export default function GroupAdd({ close, refetch }) {
    const [newGroupName, setNewGroupName] = useState();

    const [data, error, createGroup] = useCreateGroup(newGroupName);

    useEffect(() => {
        refetch();
    }, [data]);

    if (error) {
        console.log(error);
    }

    return (
        <>
            <div className="overlay"></div>
            <div className="group-add-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="group-add-panel">
                        <div className="panel-title">Stwórz nową grupę</div>
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
                                        variant="outlined"
                                        size="small"
                                        id="username"
                                        onChange={(e) =>
                                            setNewGroupName(e.target.value)
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
