import React, { useEffect, useState } from "react";
import useGetAllClassrooms from "../../../classrooms/hooks/useGetAllClassrooms";
import useGetAllGroups from "../../../students/hooks/useGetAllGroups";
import { LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { ClickAwayListener } from "@mui/base";
import { MenuItem } from "@mui/material";
import CloseIcon from "@mui/icons-material/Close";
import "./reservationdetails.scss";
import {
    GuacamoleButton,
    GuacamoleInput,
    GuacamoleSelect,
    GuacamoleTimePicker,
} from "../../../../mui";
import { IconButton } from "@mui/material";
import EditIcon from "@mui/icons-material/Edit";
import EditOffIcon from "@mui/icons-material/EditOff";
import useEditReservation from "../../hooks/useEditReservation";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";
import dayjs from "dayjs";

export default function ReservationDetails({
    reservation,
    refetch,
    setReservationDetailsPanelState,
}) {
    // Form edit mode state

    const [nameEditActive, setNameEditActive] = useState(false);
    const [groupEditActive, setGroupEditActive] = useState(false);
    const [classroomEditActive, setClassroomEditActive] = useState(false);
    const [lengthEditActive, setLengthEditActive] = useState(false);

    // Form Fields state

    const [newName, setNewName] = useState("");
    const [newClassroom, setNewClassroom] = useState("");
    const [newGroup, setNewGroup] = useState("");
    const [newStart, setNewStart] = useState();
    const [newEnd, setNewEnd] = useState();

    // Form validation

    const [validForm, setValidForm] = useState(false);

    useEffect(() => {
        if (newName || newClassroom || newGroup || newStart || newEnd) {
            setValidForm(true);
        } else setValidForm(false);
    }, [newName, newClassroom, newGroup, newStart, newEnd]);

    // Close panel function

    const close = () => {
        setReservationDetailsPanelState(false);
    };

    // Queries for selection data

    const {
        data: classroomList,
        loading: classroomListLoading,
        error: classroomListLoadingError,
    } = useGetAllClassrooms();

    const {
        data: groupList,
        loading: groupListLoading,
        error: groupListLoadingError,
    } = useGetAllGroups();

    // Edit Reservation hook declaration

    const {
        data: editReservationData,
        error: editReservationError,
        editReservation,
    } = useEditReservation(reservation.id, {
        name: newName ? newName : undefined,
        class_room_id: newClassroom ? newClassroom.id : undefined,
        class_id: newGroup ? newGroup.id : undefined,
        start: newStart
            ? `${dayjs(reservation.start, "DD-MM").format(
                  "YYYY-MM-DD"
              )} ${newStart}`
            : undefined,
        end: newEnd
            ? `${dayjs(reservation.start, "DD-MM").format(
                  "YYYY-MM-DD"
              )} ${newEnd}`
            : undefined,
    });

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (editReservationData.success) {
                close();
            }
        } catch {}
    }, [editReservationData]);

    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="overlay"></div>
            <div className="reservation-details-container">
                <ClickAwayListener
                    onClickAway={(e) => {
                        if (
                            e.target.className ==
                            "reservation-details-container"
                        ) {
                            close();
                        }
                    }}
                >
                    <div className="reservation-details-panel">
                        {groupListLoading || classroomListLoading ? (
                            <LoadingSpinner />
                        ) : (
                            <div className="reservation-details">
                                {/* Reservation Name  */}
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Nazwa
                                    </label>
                                    <div className="detail-container">
                                        <div
                                            className={`detail ${
                                                nameEditActive ? "edit" : ""
                                            }`}
                                        >
                                            <GuacamoleInput
                                                placeholder={reservation.name}
                                                value={newName}
                                                InputProps={{
                                                    readOnly: !nameEditActive,
                                                }}
                                                onChange={(e) => {
                                                    setNewName(e.target.value);
                                                }}
                                            />
                                        </div>
                                        <div className="detail-edit">
                                            <IconButton
                                                size="small"
                                                onClick={() => {
                                                    setNameEditActive(
                                                        !nameEditActive
                                                    );
                                                    setNewName("");
                                                }}
                                            >
                                                {nameEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </div>
                                    </div>
                                </div>
                                {/* Reservation Length  */}
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Czas trwania
                                    </label>
                                    <div className="detail-container">
                                        {lengthEditActive ? (
                                            <div className="detail edit">
                                                <div className="time-range-picker">
                                                    <GuacamoleTimePicker
                                                        className="form-input"
                                                        ampm={false}
                                                        format={"HH:mm"}
                                                        defaultValue={dayjs(
                                                            reservation.start,
                                                            "DD-MM HH:mm"
                                                        )}
                                                        disabled={
                                                            !lengthEditActive
                                                        }
                                                        onChange={(value) => {
                                                            setNewStart(
                                                                value.format(
                                                                    "HH:mm"
                                                                )
                                                            );
                                                        }}
                                                    />
                                                    <span>do</span>
                                                    <GuacamoleTimePicker
                                                        className="form-input"
                                                        ampm={false}
                                                        defaultValue={dayjs(
                                                            reservation.end,
                                                            "DD-MM HH:mm"
                                                        )}
                                                        disabled={
                                                            !lengthEditActive
                                                        }
                                                        onChange={(value) =>
                                                            setNewEnd(
                                                                value.format(
                                                                    "HH:mm"
                                                                )
                                                            )
                                                        }
                                                    />
                                                </div>
                                            </div>
                                        ) : (
                                            <div className="detail static">
                                                {reservation.start.slice(6)} do{" "}
                                                {reservation.end.slice(6)}
                                            </div>
                                        )}
                                        <div className="detail-edit">
                                            <IconButton
                                                size="small"
                                                onClick={() => {
                                                    setLengthEditActive(
                                                        !lengthEditActive
                                                    );
                                                    setNewStart("");
                                                    setNewEnd("");
                                                }}
                                            >
                                                {lengthEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </div>
                                    </div>
                                </div>
                                {/* Reservation Classroom  */}
                                <div className="detail-group">
                                    <label className="detail-label">Sala</label>
                                    <div className="detail-container">
                                        {classroomEditActive ? (
                                            <div className="detail edit-select">
                                                <GuacamoleSelect
                                                    className="form-input form-input-narrow"
                                                    value={newClassroom}
                                                    onChange={(e) =>
                                                        setNewClassroom(
                                                            e.target.value
                                                        )
                                                    }
                                                >
                                                    {classroomList.classrooms.map(
                                                        (classroom) => {
                                                            return (
                                                                <MenuItem
                                                                    key={
                                                                        classroom.id
                                                                    }
                                                                    value={
                                                                        classroom
                                                                    }
                                                                >
                                                                    {
                                                                        classroom.name
                                                                    }
                                                                </MenuItem>
                                                            );
                                                        }
                                                    )}
                                                </GuacamoleSelect>
                                            </div>
                                        ) : (
                                            <div className="detail static">
                                                {reservation.class_room.name}
                                            </div>
                                        )}
                                        <div className="detail-edit">
                                            <IconButton
                                                size="small"
                                                onClick={() => {
                                                    setClassroomEditActive(
                                                        !classroomEditActive
                                                    );
                                                    setNewClassroom("");
                                                }}
                                            >
                                                {classroomEditActive ? (
                                                    <EditOffIcon />
                                                ) : (
                                                    <EditIcon />
                                                )}
                                            </IconButton>
                                        </div>
                                    </div>
                                </div>
                                {/* Reservation Class  */}
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Grupa
                                    </label>
                                    <div className="detail-container">
                                        {groupEditActive ? (
                                            <div className="detail edit-select">
                                                <GuacamoleSelect
                                                    className="form-input form-input-narrow"
                                                    value={newGroup}
                                                    onChange={(e) =>
                                                        setNewGroup(
                                                            e.target.value
                                                        )
                                                    }
                                                >
                                                    {groupList.class.map(
                                                        (group) => {
                                                            return (
                                                                <MenuItem
                                                                    key={
                                                                        group.id
                                                                    }
                                                                    value={
                                                                        group
                                                                    }
                                                                >
                                                                    {group.name}
                                                                </MenuItem>
                                                            );
                                                        }
                                                    )}
                                                </GuacamoleSelect>
                                            </div>
                                        ) : (
                                            <div className="detail static">
                                                {reservation.class.name}
                                            </div>
                                        )}
                                        <div className="detail-edit">
                                            <IconButton
                                                size="small"
                                                onClick={() => {
                                                    setGroupEditActive(
                                                        !groupEditActive
                                                    );
                                                    setNewGroup("");
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
                                <div className="panel-actions">
                                    <GuacamoleButton
                                        onClick={() => editReservation()}
                                        disabled={!validForm}
                                    >
                                        Zapisz
                                    </GuacamoleButton>
                                </div>
                                <div className="panel-close">
                                    <IconButton onClick={() => close()}>
                                        <CloseIcon />
                                    </IconButton>
                                </div>
                            </div>
                        )}
                    </div>
                </ClickAwayListener>
            </div>
        </LocalizationProvider>
    );
}
