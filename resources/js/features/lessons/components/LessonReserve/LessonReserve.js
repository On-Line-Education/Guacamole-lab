import { DateTimePicker } from "@mui/x-date-pickers";
import React, { useState } from "react";
import {
    GuacamoleButton,
    GuacamoleDateTimePicker,
    GuacamoleSelect,
} from "../../../../mui";
import "./lessonreserve.scss";
import { LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { MenuItem } from "@mui/material";
import useGetAllClassrooms from "../../../classrooms/hooks/useGetAllClassrooms";

export default function LessonReserve() {
    const [classroom, setClassroom] = useState("");
    const [duration, setDuration] = useState(60);

    const {
        data: classroomList,
        loading: classroomListLoading,
        error: classroomListLoadingError,
    } = useGetAllClassrooms();

    if (classroomListLoading) {
        return "Loading..";
    }

    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="lesson-create-container">
                <div className="title lesson-create-title">
                    Wybierz salę i czas zajęć
                </div>
                <div className="panel lesson-create-panel">
                    <form className="panel-form lesson-create-form">
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
                                                    value={classroom.name}
                                                >
                                                    {classroom.name}
                                                </MenuItem>
                                            );
                                        }
                                    )
                                ) : (
                                    <MenuItem value={10}>Ten</MenuItem>
                                )}
                            </GuacamoleSelect>
                        </div>
                        <div className="form-group">
                            <label className="form-label">Start</label>
                            <GuacamoleDateTimePicker
                                className="form-input"
                                size="small"
                                id="lesson-start"
                                ampm={false}
                            />
                        </div>
                        <div className="form-group">
                            <label className="form-label">Czas trwania</label>
                            <GuacamoleSelect
                                id="lesson-classroom"
                                className="form-input"
                                value={duration}
                                onChange={(e) => setDuration(e.target.value)}
                            >
                                <MenuItem value="30">30 minut</MenuItem>
                                <MenuItem value="45">45 minut</MenuItem>
                                <MenuItem value="60">60 minut</MenuItem>
                                <MenuItem value="90">90 minut</MenuItem>
                                <MenuItem value="120">2 godziny</MenuItem>
                                <MenuItem value="120">2.5 godziny</MenuItem>
                                <MenuItem value="180">3 godziny</MenuItem>
                            </GuacamoleSelect>
                        </div>
                        <div className="form-actions student-import-actions"></div>
                    </form>
                </div>
            </div>
        </LocalizationProvider>
    );
}
