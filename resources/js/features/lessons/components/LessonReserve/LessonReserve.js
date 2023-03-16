import React, { useState, useEffect } from "react";
import { useSelector } from "react-redux";
import useGetAllClassrooms from "../../../classrooms/hooks/useGetAllClassrooms";
import useGetAllGroups from "../../../students/hooks/useGetAllGroups";
import useCreateReservation from "../../hooks/useCreateReservation";
import "./lessonreserve.scss";
import {
    GuacamoleButton,
    GuacamoleInput,
    GuacamoleDateTimePicker,
    GuacamoleSelect,
    GuacamoleDatePicker,
    GuacamoleTimePicker,
} from "../../../../mui";
import { LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { MenuItem } from "@mui/material";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function LessonReserve({ refetch }) {
    // Form state

    const [reservationClassroom, setReservationClassroom] = useState("");
    const [reservationGroup, setReservationGroup] = useState("");
    const [reservationName, setReservationName] = useState(undefined);
    const [reservationDate, setReservationDate] = useState(undefined);
    const [reservationStartTime, setReservationStartTime] = useState(undefined);
    const [reservationEndTime, setReservationEndTime] = useState(undefined);

    // Form validation

    const [validForm, setValidForm] = useState(false);

    useEffect(() => {
        if (
            reservationClassroom &&
            reservationGroup &&
            reservationName &&
            reservationDate &&
            reservationStartTime &&
            reservationEndTime
        ) {
            setValidForm(true);
        }
    }, [
        reservationClassroom,
        reservationGroup,
        reservationName,
        reservationDate,
        reservationStartTime,
        reservationEndTime,
    ]);

    // Getting logged teacher id from redux store

    const instructorId = useSelector((state) => state.auth.id);

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

    // Reserve lesson hook

    const { error, data, createReservation } = useCreateReservation({
        instructorId,
        reservationClassroom,
        reservationGroup,
        reservationName,
        reservationDate,
        reservationStartTime,
        reservationEndTime,
    });

    // Submit logic

    const handleSubmit = (e) => {
        e.preventDefault();
        createReservation();
        refetch();
    };

    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="lesson-create-container">
                <div className="lesson-create-title">
                    Zarezerwuj nowe zajęcia
                </div>
                <div className="lesson-create-panel">
                    {groupListLoading || classroomListLoading ? (
                        <LoadingSpinner />
                    ) : (
                        <form
                            className="lesson-create-form"
                            onSubmit={(e) => {
                                handleSubmit(e);
                            }}
                        >
                            <div className="form-group">
                                <label className="form-label">Nazwa</label>
                                <GuacamoleInput
                                    className="form-input"
                                    placeholder="Nazwa"
                                    onChange={(e) =>
                                        setReservationName(e.target.value)
                                    }
                                />
                            </div>
                            <div className="form-group">
                                <label className="form-label">Dzień</label>
                                <GuacamoleDatePicker
                                    className="form-input"
                                    onChange={(value) =>
                                        setReservationDate(
                                            value.format("YYYY-MM-DD")
                                        )
                                    }
                                />
                            </div>
                            <div className="form-group">
                                <label className="form-label">
                                    Czas trwania
                                </label>
                                <div className="time-range-picker">
                                    <GuacamoleTimePicker
                                        className="form-input"
                                        ampm={false}
                                        onChange={(value) => {
                                            setReservationStartTime(
                                                value.format("HH:mm")
                                            );
                                        }}
                                    />
                                    <span>-</span>
                                    <GuacamoleTimePicker
                                        className="form-input"
                                        ampm={false}
                                        onChange={(value) =>
                                            setReservationEndTime(
                                                value.format("HH:mm")
                                            )
                                        }
                                    />
                                </div>
                            </div>
                            <div className="form-group">
                                <label className="form-label">Sala</label>
                                <GuacamoleSelect
                                    className="form-input form-input-narrow"
                                    value={reservationClassroom}
                                    onChange={(e) =>
                                        setReservationClassroom(e.target.value)
                                    }
                                >
                                    {classroomList.classrooms.length > 0 ? (
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
                            </div>
                            <div className="form-group">
                                <label className="form-label">Klasa</label>
                                <GuacamoleSelect
                                    className="form-input form-input-narrow"
                                    value={reservationGroup}
                                    onChange={(e) =>
                                        setReservationGroup(e.target.value)
                                    }
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
                            </div>
                            <div className="panel-actions">
                                <GuacamoleButton
                                    type="submit"
                                    disabled={!validForm}
                                >
                                    Zarezerwuj
                                </GuacamoleButton>
                            </div>
                        </form>
                    )}
                </div>
            </div>
        </LocalizationProvider>
    );
}
