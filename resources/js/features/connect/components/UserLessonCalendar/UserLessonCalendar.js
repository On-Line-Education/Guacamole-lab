import React, { useState, useEffect } from "react";
import "./userlessoncalendar.scss";
import { DateCalendar, LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function UserLessonCalendar({
    date,
    setDate,
    reservationList,
    loading,
}) {
    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <div className="user-lesson-calendar-container">
                <div className="user-lesson-calendar-title">
                    Kalendarz zajęć
                </div>
                <div className="user-lesson-calendar-panel">
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
