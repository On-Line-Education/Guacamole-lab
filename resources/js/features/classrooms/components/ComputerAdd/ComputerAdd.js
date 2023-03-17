import React, { useState } from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./computeradd.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useCreateComputer from "../../hooks/useCreateComputer";

export default function ComputerAdd({ close, classroom }) {
    // Form fields state
    const [newComputerName, setNewComputerName] = useState();
    const [newComputerIp, setNewComputerIp] = useState();
    const [newComputerMac, setNewComputerMac] = useState();
    const [newComputerLogin, setNewComputerLogin] = useState();

    // Create Computer hook declaration

    const [error, loading, createComputer] = useCreateComputer(
        classroom.id,
        newComputerName,
        newComputerIp,
        newComputerMac,
        newComputerLogin
    );

    return (
        <>
            <div className="overlay"></div>
            <div className="computer-add-container">
                <ClickAwayListener onClickAway={() => close(false)}>
                    <div className="computer-add-panel">
                        <div className="panel-title">Stwórz nowego ucznia</div>
                        <div className="panel-close">
                            <IconButton onClick={() => close(false)}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                        <div className="computer-add-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();
                                    createComputer();
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">Nazwa</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        variant="outlined"
                                        size="small"
                                        id="computer-name"
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
                                        className="form-input"
                                        variant="outlined"
                                        size="small"
                                        id="computer-ip"
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
                                        variant="outlined"
                                        size="small"
                                        id="computer-mac"
                                        onChange={(e) =>
                                            setNewComputerMac(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">Login</label>
                                    <GuacamoleInput
                                        className="form-input"
                                        variant="outlined"
                                        size="small"
                                        id="computer-login"
                                        onChange={(e) =>
                                            setNewComputerLogin(e.target.value)
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
