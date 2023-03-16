import React, { useState, useEffect } from "react";
import "./lessoncalendar.scss";
import { DateCalendar, LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function LessonCalendar({
    date,
    setDate,
    reservationList,
    loading,
}) {
    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="lesson-calendar-container">
                <div className="lesson-calendar-title">Kalendarz zajęć</div>
                <div className="lesson-calendar-panel">
                    {loading ? (
                        <LoadingSpinner />
                    ) : (
                        <DateCalendar
                            value={date}
                            onChange={(newDate) => {
                                setDate(newDate);
                            }}
                        />
                    )}
                </div>
            </div>
        </LocalizationProvider>
    );
}
