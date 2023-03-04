import React from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./grouptile.scss";
import { IconButton } from "@mui/material";

export default function GroupTile({ id, name }) {
    return (
        <div className="group-tile">
            <div className="group-tile-name">{name}</div>
            <div className="group-tile-delete">
                <IconButton
                    onClick={() => {
                        console.log(`delete group ${id}`);
                    }}
                >
                    <CloseIcon color="error" />
                </IconButton>
            </div>
        </div>
    );
}
