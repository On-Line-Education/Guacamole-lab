import { DateTimePicker } from "@mui/x-date-pickers";
import React, { useState } from "react";
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
} from "../../../../mui";
import { LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { MenuItem } from "@mui/material";

export default function LessonReserve() {
    // Form variables

    const [classroom, setClassroom] = useState("");
    const [group, setGroup] = useState("");
    const [name, setName] = useState("");
    const [start, setStart] = useState("");
    const [end, setEnd] = useState("");

    // Getting logged teacher id from redux store

    const teacherId = useSelector((state) => state.auth.id);

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

    // Reserve lesson hook declaration

    const { error, data, createReservation } = useCreateReservation(
        name,
        teacherId,
        classroom,
        group,
        start,
        end
    );

    if (classroomListLoading || groupListLoading) {
        return "Loading..";
    }

    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="lesson-create-container">
                <div className="title lesson-create-title">
                    Zarezerwuj nowe zajęcia
                </div>
                <div className="panel lesson-create-panel">
                    <form
                        className="panel-form lesson-create-form"
                        onSubmit={(e) => {
                            e.preventDefault();
                            createReservation();
                        }}
                    >
                        <div className="form-group">
                            <label className="form-label">Sala</label>
                            <GuacamoleSelect
                                id="lesson-classroom"
                                className="form-input"
                                value={classroom}
                                onChange={(e) => setClassroom(e.target.value)}
                                sx={{ width: "200px !important" }}
                            >
                                {classroomList.classrooms.length > 0 ? (
                                    classroomList.classrooms.map(
                                        (classroom) => {
                                            return (
                                                <MenuItem
                                                    key={classroom.id}
                                                    value={classroom.id}
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
                                id="lesson-classroom"
                                className="form-input"
                                value={group}
                                onChange={(e) => setGroup(e.target.value)}
                                sx={{ width: "200px !important" }}
                            >
                                {groupList.class.length > 0 ? (
                                    groupList.class.map((group) => {
                                        return (
                                            <MenuItem
                                                key={group.id}
                                                value={group.id}
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
                        <div className="form-group">
                            <label className="form-label">Nazwa</label>
                            <GuacamoleInput
                                className="form-input"
                                variant="outlined"
                                size="small"
                                id="name"
                                onChange={(e) => setName(e.target.value)}
                            />
                        </div>
                        <div className="form-group">
                            <label className="form-label">Start</label>
                            <GuacamoleDateTimePicker
                                className="form-input"
                                size="small"
                                id="lesson-start"
                                ampm={false}
                                onChange={(value) =>
                                    setStart(
                                        value.format("YYYY-MM-DD hh:mm:ss")
                                    )
                                }
                            />
                        </div>
                        <div className="form-group">
                            <label className="form-label">Koniec</label>
                            <GuacamoleDateTimePicker
                                className="form-input"
                                size="small"
                                id="lesson-end"
                                ampm={false}
                                onChange={(value) =>
                                    setEnd(value.format("YYYY-MM-DD hh:mm:ss"))
                                }
                            />
                        </div>
                        <div className="panel-actions">
                            <GuacamoleButton type="submit">
                                Zarezerwuj
                            </GuacamoleButton>
                        </div>
                    </form>
                </div>
            </div>
        </LocalizationProvider>
    );
}
