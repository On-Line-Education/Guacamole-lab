import React from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import Logo from "../../components/Logo/Logo";
import "./assets/style.scss";
import LessonCreate from "./components/LessonCreate/LessonCreate";

export default function LessonsView() {
    return (
        <div className="lessons">
            <Logo />
            <Sidebar active={"lessons"} />
            <div className="lessons-container">
                <LessonCreate />
            </div>
        </div>
    );
}
