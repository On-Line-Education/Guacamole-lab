import React, { useState, useEffect } from "react";
import CloseIcon from "@mui/icons-material/Close";
import "./studentdetails.scss";
import { IconButton } from "@mui/material";
import { ClickAwayListener } from "@mui/base";
import {
    GuacamoleButton,
    GuacamoleFragileButton,
    GuacamoleInput,
    GuacamoleSelect,
} from "../../../../mui";
import EditIcon from "@mui/icons-material/Edit";
import EditOffIcon from "@mui/icons-material/EditOff";
import useDeleteStudent from "../../hooks/useDeleteStudent";
import useEditStudent from "../../hooks/useEditStudent";
import useGetAllGroups from "../../hooks/useGetAllGroups";
import { MenuItem } from "@mui/material";
import useEditStudentGroups from "../../hooks/useEditStudentGroups";

export default function StudentDetails({
    student,
    refetch,
    setStudentDetailsPanelState,
}) {
    // Form edit state

    const [groupEditActive, setGroupEditActive] = useState(false);

    // Form fields state
    const [newGroup, setNewGroup] = useState([]);

    // Delete Student hook declarataion
    const { data: deleteStudentData, deleteStudent } = useDeleteStudent(
        student.id
    );

    // Edit Student Groups hook declarataion and handling

    const { data: editStudentGroupsData, editStudentGroups } =
        useEditStudentGroups(student.id, {
            groups: newGroup.map((group) => group.id),
        });

    // Get All Groups hook declaration

    const { data: groupList, loading } = useGetAllGroups();

    // Close panel function

    const close = () => {
        setStudentDetailsPanelState(false);
    };

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (deleteStudentData.success) {
                close();
            }
        } catch {}
    }, [deleteStudentData]);

    useEffect(() => {
        try {
            if (editStudentGroupsData.success) {
                refetch();
                close();
            }
        } catch {}
    }, [editStudentGroupsData]);

    // Form Select handling
    const handleChange = (event) => {
        const {
            target: { value },
        } = event;
        setNewGroup(
            // On autofill we get a stringified value.
            typeof value === "string" ? value.split(",") : value
        );
    };

    if (loading) return <>Loading</>;

    return (
        <>
            <div className="overlay"></div>
            <div className="student-details-container">
                <ClickAwayListener
                    onClickAway={(e) => {
                        if (e.target.className == "overlay") {
                            close();
                        }
                    }}
                >
                    <div className="student-details-panel">
                        <div className="student-details">
                            {/* Student name */}
                            <div className="detail-group">
                                <label className="detail-label">Nazwa</label>
                                <div className="detail-container">
                                    <div className={`detail`}>
                                        <GuacamoleInput
                                            placeholder={student.username}
                                            InputProps={{
                                                readOnly: true,
                                            }}
                                        />
                                    </div>
                                </div>
                            </div>
                            {/* Computer groups  */}
                            <div className="detail-group">
                                <label className="detail-label">Grupy</label>
                                <div className="detail-container">
                                    <div
                                        className={`detail ${
                                            groupEditActive ? "edit" : ""
                                        }`}
                                    >
                                        <GuacamoleSelect
                                            className="group-select"
                                            defaultValue={student.classes}
                                            displayEmpty
                                            multiple
                                            value={newGroup}
                                            onChange={handleChange}
                                            disabled={!groupEditActive}
                                            renderValue={(selected) => {
                                                if (
                                                    selected.length === 0 &&
                                                    !groupEditActive
                                                ) {
                                                    return student.classes
                                                        .map(
                                                            (group) =>
                                                                group.name
                                                        )
                                                        .join(", ");
                                                }

                                                if (
                                                    selected.length === 0 &&
                                                    groupEditActive
                                                ) {
                                                    return "Wybierz grupy";
                                                }
                                                return selected
                                                    .map((entry) => entry.name)
                                                    .join(", ");
                                            }}
                                        >
                                            {groupList.class.map((group) => (
                                                <MenuItem
                                                    key={group.id}
                                                    value={group}
                                                >
                                                    {group.name}
                                                </MenuItem>
                                            ))}
                                        </GuacamoleSelect>
                                    </div>
                                    <div className="detail-edit">
                                        <IconButton
                                            size="small"
                                            onClick={() => {
                                                setGroupEditActive(
                                                    !groupEditActive
                                                );
                                                setNewGroup([]);
                                            }}
                                        >
                                            {groupEditActive ? (
                                                <EditOffIcon />
                                            ) : (
                                                <EditIcon />
                                            )}
                                        </IconButton>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="panel-actions">
                            <GuacamoleFragileButton
                                sx={{ width: "45%" }}
                                onClick={() => deleteStudent()}
                            >
                                Usuń Ucznia
                            </GuacamoleFragileButton>
                            <GuacamoleButton
                                sx={{ width: "45%" }}
                                disabled={newGroup.length < 1}
                                onClick={() => {
                                    {
                                        editStudentGroups();
                                    }
                                }}
                            >
                                Edytuj dane
                            </GuacamoleButton>
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
