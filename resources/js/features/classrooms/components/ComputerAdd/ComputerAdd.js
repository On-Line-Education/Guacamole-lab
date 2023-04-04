import React, { useState, useEffect } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./computeradd.scss";
import { Checkbox, IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateComputer from "../../hooks/useCreateComputer";

export default function ComputerAdd({
    classroom,
    refetch,
    setComputerAdditionPanelState,
}) {
    // Form fields state
    const [newComputerName, setNewComputerName] = useState();
    const [newComputerIp, setNewComputerIp] = useState();
    const [newComputerMac, setNewComputerMac] = useState();
    const [newComputerBroadcast, setNewComputerBroadcast] = useState();
    const [newComputerIsInstructors, setNewComputerIsInstructors] =
        useState(false);

    // Create Computer hook declaration
    const { data, createComputer } = useCreateComputer(
        classroom.id,
        newComputerName,
        newComputerIp,
        newComputerMac,
        newComputerBroadcast,
        newComputerIsInstructors
    );

    // Close panel function
    const close = () => {
        setComputerAdditionPanelState(false);
    };

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (data.success) close();
        } catch {}
    }, [data]);

    const handleSubmit = (e) => {
        e.preventDefault();

        createComputer();
    };

    return (
        <>
            <div className="overlay"></div>
            <div className="computer-add-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="computer-add-panel">
                        <div className="panel-title">Dodaj nowy komputer</div>
                        <div className="panel-close">
                            <IconButton onClick={() => close()}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                        <div className="computer-add-form">
                            <form
                                onSubmit={(e) => {
                                    handleSubmit(e);
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">Nazwa</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        required
                                        onChange={(e) =>
                                            setNewComputerName(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">
                                        Adres Ip
                                    </label>
                                    <GuacamoleInput
                                        required
                                        className="form-input"
                                        onChange={(e) =>
                                            setNewComputerIp(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">
                                        Adres Mac
                                    </label>
                                    <GuacamoleInput
                                        className="form-input"
                                        onChange={(e) =>
                                            setNewComputerMac(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">
                                        Adres broadcast
                                    </label>
                                    <GuacamoleInput
                                        className="form-input"
                                        onChange={(e) =>
                                            setNewComputerBroadcast(
                                                e.target.value
                                            )
                                        }
                                    />
                                </div>
                                <div className="form-group-checkbox">
                                    <Checkbox
                                        onChange={(e) =>
                                            setNewComputerIsInstructors(
                                                e.target.checked
                                            )
                                        }
                                    />
                                    <label className="form-label">
                                        Komputer instruktorski
                                    </label>
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
