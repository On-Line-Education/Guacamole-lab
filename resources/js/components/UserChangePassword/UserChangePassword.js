import React, { useState, useEffect } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./userchangepassword.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import useLogout from "../../features/auth/hooks/useLogout";
import useChangeUserPassword from "../../features/auth/hooks/useChangeUserPassword";
import { GuacamoleButton, GuacamoleInput } from "../../mui";

export default function UserChangePassword({
    userId,
    setUserChangePasswordPanelState,
}) {
    // Form field state

    const [oldPassword, setOldPassword] = useState();
    const [newPassword, setNewPassword] = useState();

    const { data, changeUserPassword } = useChangeUserPassword(
        userId,
        oldPassword,
        newPassword
    );

    // Logout hook declaration

    const { error, logout } = useLogout();

    // Refetch logic

    useEffect(() => {
        try {
            if (data.success) {
                logout();
            }
        } catch (e) {}
    }, [data]);

    // close panel function

    const close = () => {
        setUserChangePasswordPanelState(false);
    };

    return (
        <>
            <div className="overlay"></div>
            <div className="user-password-change-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="user-password-change-panel">
                        <div className="panel-title">
                            Zmień hasło użytkownika:
                        </div>
                        <div className="panel-form">
                            <form
                                onSubmit={(e) => {
                                    e.preventDefault();

                                    changeUserPassword();
                                }}
                            >
                                <div className="form-group">
                                    <label className="form-label">
                                        Stare Hasło
                                    </label>
                                    <GuacamoleInput
                                        className="form-input"
                                        size="small"
                                        type="password"
                                        required
                                        onChange={(e) =>
                                            setOldPassword(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="form-group">
                                    <label className="form-label">
                                        Nowe Hasło
                                    </label>
                                    <GuacamoleInput
                                        className="form-input"
                                        size="small"
                                        type="password"
                                        required
                                        onChange={(e) =>
                                            setNewPassword(e.target.value)
                                        }
                                    />
                                </div>
                                <div className="panel-actions">
                                    <GuacamoleButton
                                        type="submit"
                                        disabled={!newPassword || !oldPassword}
                                    >
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
