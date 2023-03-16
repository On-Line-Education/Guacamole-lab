import React from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./grouptile.scss";
import { IconButton } from "@mui/material";
import useUnassignGroup from "../../hooks/useUnassignGroup";

export default function GroupTile({ className, classId, userId }) {
    const {
        data,
        loading,
        error: unassignGroupError,
        unassign,
    } = useUnassignGroup(classId, userId);

    return (
        <div className="group-tile">
            <div className="group-tile-name">{className}</div>
            <div className="group-tile-delete">
                <IconButton
                    onClick={() => {
                        unassign();
                    }}
                >
                    <CloseIcon color="error" />
                </IconButton>
            </div>
        </div>
    );
}
