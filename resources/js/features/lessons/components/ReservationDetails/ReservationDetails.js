import React, { useEffect, useState } from "react";
import useGetAllClassrooms from "../../../classrooms/hooks/useGetAllClassrooms";
import useGetAllGroups from "../../../students/hooks/useGetAllGroups";
import useDeleteReservation from "../../hooks/useDeleteReservation";
import { LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { ClickAwayListener } from "@mui/base";
import { FormControl, InputLabel, MenuItem } from "@mui/material";
import CloseIcon from "@mui/icons-material/Close";
import "./reservationdetails.scss";
import {
    GuacamoleButton,
    GuacamoleDateTimePicker,
    GuacamoleFragileButton,
    GuacamoleSelect,
} from "../../../../mui";
import { IconButton, TextField } from "@mui/material";
import EditIcon from "@mui/icons-material/Edit";
import EditOffIcon from "@mui/icons-material/EditOff";
import useEditReservation from "../../hooks/useEditReservation";

export default function ReservationDetails({ reservation, close }) {
    // Field edit mode state

    const [nameEditActive, setNameEditActive] = useState(false);
    const [groupEditActive, setGroupEditActive] = useState(false);
    const [classroomEditActive, setClassroomEditActive] = useState(false);
    const [startEditActive, setStartEditActive] = useState(false);
    const [endEditActive, setEndEditActive] = useState(false);

    // New params

    const [newName, setNewName] = useState({});
    const [newClassroom, setNewClassroom] = useState({});
    const [newGroup, setNewGroup] = useState({});
    const [newStart, setNewStart] = useState(undefined);
    const [newEnd, setNewEnd] = useState(undefined);

    // Tracking edition state

    const [editState, setEditState] = useState(false);
    const [editedValues, setEditedValues] = useState("");

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

    // Delete query

    const { error: deleteReservationError, deleteReservation } =
        useDeleteReservation(reservation.id);

    // Edit Reservation

    const { error: editReservationError, editReservation } = useEditReservation(
        editedValues,
        reservation.id
    );

    useEffect(() => {
        if (newName || newGroup || newClassroom || newStart || newEnd) {
            setEditState(true);
            setEditedValues({
                class_room_id: newClassroom.id,
                class_id: newGroup.id,
                start: newStart,
                end: newEnd,
            });
        }
    }, [newName, newGroup, newClassroom, newStart, newEnd]);

    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="overlay"></div>
            <div className="reservation-details-container">
                <ClickAwayListener
                    onClickAway={(e) => {
                        if (e.target.className == "overlay") {
                            close(false);
                        }
                    }}
                >
                    <div className="reservation-details">
                        <div className="reservation-name">
                            {reservation.name}
                        </div>
                        <div className="reservation-classroom">
                            <div className="reservation-param-key">Sala:</div>
                            <div className="reservation-param-value">
                                {classroomEditActive ? (
                                    <GuacamoleSelect
                                        id="lesson-classroom"
                                        className="form-input"
                                        value={newClassroom}
                                        label={reservation.class_room.name}
                                        onChange={(e) => {
                                            setNewClassroom(e.target.value);
                                        }}
                                        displayEmpty
                                        renderValue={
                                            newClassroom !== ""
                                                ? undefined
                                                : () =>
                                                      reservation.class_room
                                                          .name
                                        }
                                        sx={{ width: "200px !important" }}
                                    >
                                        {classroomListLoading ? (
                                            <div>Loading</div>
                                        ) : classroomList.classrooms.length >
                                          0 ? (
                                            classroomList.classrooms.map(
                                                (classroom) => {
                                                    return (
                                                        <MenuItem
                                                            key={classroom.id}
                                                            value={classroom}
                                                        >
                                                            {classroom.name}
                                                        </MenuItem>
                                                    );
                                                }
                                            )
                                        ) : (
                                            <MenuItem value={""}>
                                                Brak dostępnych sal
                                            </MenuItem>
                                        )}
                                    </GuacamoleSelect>
                                ) : (
                                    reservation.class_room.name
                                )}
                            </div>
                            <div className="reservation-param-edit">
                                <IconButton
                                    size="small"
                                    color="primary"
                                    onClick={() => {
                                        setNewClassroom("");
                                        setClassroomEditActive(
                                            !classroomEditActive
                                        );
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
                        <div className="reservation-class">
                            <div className="reservation-param-key">Klasa:</div>
                            <div className="reservation-param-value">
                                {groupEditActive ? (
                                    <GuacamoleSelect
                                        id="lesson-classroom"
                                        className="form-input"
                                        value={newGroup}
                                        onChange={(e) => {
                                            setNewGroup(e.target.value);
                                        }}
                                        displayEmpty
                                        renderValue={
                                            newGroup !== ""
                                                ? undefined
                                                : () => reservation.class.name
                                        }
                                        sx={{ width: "200px !important" }}
                                    >
                                        {groupList.class.length > 0 ? (
                                            groupList.class.map((group) => {
                                                return (
                                                    <MenuItem
                                                        key={group.id}
                                                        value={group}
                                                    >
                                                        {group.name}
                                                    </MenuItem>
                                                );
                                            })
                                        ) : (
                                            <MenuItem value={""}>
                                                Brak dostępnych klas
                                            </MenuItem>
                                        )}
                                    </GuacamoleSelect>
                                ) : (
                                    reservation.class.name
                                )}
                            </div>
                            <div className="reservation-param-edit">
                                <IconButton
                                    size="small"
                                    color="primary"
                                    onClick={() => {
                                        setNewGroup("");
                                        setGroupEditActive(!groupEditActive);
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
                        <div className="reservation-start">
                            <div className="reservation-param-key">Start:</div>
                            <div className="reservation-param-value">
                                {startEditActive ? (
                                    <GuacamoleDateTimePicker
                                        className="form-input"
                                        size="small"
                                        id="lesson-start"
                                        ampm={false}
                                        onChange={(value) =>
                                            setNewStart(
                                                value.format(
                                                    "YYYY-MM-DD hh:mm:ss"
                                                )
                                            )
                                        }
                                    />
                                ) : (
                                    reservation.start
                                )}
                            </div>
                            <div className="reservation-param-edit">
                                <IconButton
                                    size="small"
                                    color="primary"
                                    onClick={() => {
                                        setNewStart("");
                                        setStartEditActive(!startEditActive);
                                    }}
                                >
                                    {startEditActive ? (
                                        <EditOffIcon />
                                    ) : (
                                        <EditIcon />
                                    )}
                                </IconButton>
                            </div>
                        </div>
                        <div className="reservation-end">
                            <div className="reservation-param-key">Koniec:</div>
                            <div className="reservation-param-value">
                                {endEditActive ? (
                                    <GuacamoleDateTimePicker
                                        className="form-input"
                                        size="small"
                                        id="lesson-start"
                                        ampm={false}
                                        onChange={(value) =>
                                            setNewStart(
                                                value.format(
                                                    "YYYY-MM-DD hh:mm:ss"
                                                )
                                            )
                                        }
                                    />
                                ) : (
                                    reservation.end
                                )}
                            </div>
                            <div className="reservation-param-edit">
                                <IconButton
                                    size="small"
                                    color="primary"
                                    onClick={() => {
                                        setNewEnd("");
                                        setEndEditActive(!endEditActive);
                                    }}
                                >
                                    {endEditActive ? (
                                        <EditOffIcon />
                                    ) : (
                                        <EditIcon />
                                    )}
                                </IconButton>
                            </div>
                        </div>
                        <div className="panel-actions">
                            <GuacamoleFragileButton
                                sx={{ width: "45%" }}
                                onClick={() => deleteReservation()}
                            >
                                Usuń Rezerwacje
                            </GuacamoleFragileButton>
                            <GuacamoleButton
                                onClick={() => editReservation()}
                                sx={{ width: "45%" }}
                                disabled={!editState}
                            >
                                Edytuj dane
                            </GuacamoleButton>
                        </div>
                        <div className="panel-close">
                            <IconButton onClick={() => close(false)}>
                                <CloseIcon />
                            </IconButton>
                        </div>
                    </div>
                </ClickAwayListener>
            </div>
        </LocalizationProvider>
    );
}
