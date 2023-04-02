import React, { useState, useEffect } from "react";
import Logo from "../../components/Logo/Logo";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./style.scss";
import UserLessonList from "./components/UserLessonList/UserLessonList";
import dayjs from "dayjs";
import UserLessonCalendar from "./components/UserLessonCalendar/UserLessonCalendar";
import useGetUserLessons from "./hooks/useGetUserLessons";
import { useSelector } from "react-redux";
import Connect from "./components/Connect/Connect";
import useGetSelectedLesson from "./hooks/useGetSelectedLesson";
import useGetAllLessons from "./hooks/useGetAllLessons";

export default function ConnectView() {
    // Get logged user Id

    const userId = useSelector((state) => state.auth.id);
    const userRole = useSelector((state) => state.auth.role);

    // Selected table row and calendar date

    const [selectedLesson, setSelectedLesson] = useState("");
    const [date, setDate] = useState(dayjs());

    // Get User Lessons hook declaration
    const {
        data: lessonList,
        loading: lessonListLoading,
        error: lessonListLoadingError,
    } = useGetUserLessons(userId);

    const {
        data: allLessonList,
        loading: allLessonListLoading,
        error: allLessonListLoadingError,
    } = useGetAllLessons(userRole === "admin" ? true : false);

    const {
        data: selectedLessonData,
        loading: selectedLessonLoading,
        error: selectedLessonLoadingError,
        getLesson,
    } = useGetSelectedLesson(selectedLesson ? selectedLesson.id : undefined);

    // Refetch logic

    useEffect(() => {
        if (selectedLesson) {
            getLesson();
        }
    }, [selectedLesson]);

    useEffect(() => {
        const scheduledTimeout = setInterval(() => {
            if (selectedLesson) {
                getLesson();
            }

            return clearInterval(scheduledTimeout);
        }, 60000);
    }, [selectedLesson]);

    return (
        <>
            <div className="connect">
                <Sidebar active={"connect"} />
                <div className="connect-container">
                    <UserLessonCalendar
                        date={date}
                        setDate={setDate}
                        reservedList={lessonList}
                        loading={lessonListLoading}
                    />
                    <UserLessonList
                        selectedSession={selectedLesson}
                        setSelectedSession={setSelectedLesson}
                        sessionList={
                            userRole === "admin" ? allLessonList : lessonList
                        }
                        loading={
                            userRole === "admin"
                                ? allLessonListLoading
                                : lessonListLoading
                        }
                        date={date}
                    />
                    <Connect
                        selectedLesson={selectedLessonData}
                        loading={selectedLessonLoading}
                    />
                </div>
            </div>
            <Logo />
        </>
    );
}
