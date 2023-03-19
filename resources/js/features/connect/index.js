import React, { useState } from "react";
import Logo from "../../components/Logo/Logo";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./style.scss";
import UserLessonList from "./components/UserLessonList/UserLessonList";
import dayjs from "dayjs";
import UserLessonCalendar from "./components/UserLessonCalendar/UserLessonCalendar";
import useGetUserLessons from "./hooks/useGetUserLessons";
import { useSelector } from "react-redux";
import Connect from "./components/Connect/Connect";

export default function ConnectView() {
    // Get logged user Id

    const userId = useSelector((state) => state.auth.id);

    // Selected table row and calendar date

    const [selectedLesson, setSelectedLesson] = useState("");
    const [date, setDate] = useState(dayjs());

    // Get User Lessons hook declaration
    const {
        data: lessonList,
        loading: lessonListLoading,
        error: lessonListLoadingError,
    } = useGetUserLessons(userId);

    console.log(lessonList);

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
                        sessionList={lessonList}
                        loading={lessonListLoading}
                        date={date}
                    />
                    <Connect selectedLesson={selectedLesson} />
                </div>
            </div>
            <Logo />
        </>
    );
}
