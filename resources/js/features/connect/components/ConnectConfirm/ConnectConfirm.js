import React from "react";
import { GuacamoleButton } from "../../../../mui";
import CloseIcon from "@mui/icons-material/Close";
import "./connectconfirm.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";

export default function ConnectConfirm({
    setConnectConfirmed,
    setConnectConfirmedPanelOpened,
}) {
    const close = () => {
        setConnectConfirmedPanelOpened(false);
    };
    return (
        <>
            <div className="overlay"></div>
            <div className="connect-confirm-container">
                <ClickAwayListener onClickAway={() => close()}>
                    <div className="connect-confirm-panel">
                        <div className="panel-title">Połącz zdalnie</div>
                        <div className="panel-close">
                            <IconButton onClick={() => close()}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                        <div className="panel-form">
                            <div className="panel-desc">
                                Za chwilę nastąpi połączenie zdalne, w twojej
                                przeglądarce zostanie otwarta nowa karta
                            </div>
                            <div className="panel-actions">
                                <GuacamoleButton
                                    onClick={() => setConnectConfirmed(true)}
                                >
                                    Połącz
                                </GuacamoleButton>
                            </div>
                        </div>
                    </div>
                </ClickAwayListener>
            </div>
        </>
    );
}
