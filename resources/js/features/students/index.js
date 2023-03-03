import React, { useState } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./assets/style.scss";
import StudentList from "./components/StudentList/StudentList";
import Logo from "../../components/Logo/Logo";
import StudentAdd from "./components/StudentAdd/StudentAdd";
import GroupList from "./components/GroupList/GroupList";
import StudentDetails from "./components/StudentDetails/StudentDetails";
import StudentImport from "./components/StudentImport/StudentImport";

export default function StudentsView() {
    const [studentAdditionPanelActive, setStudentAdditionPanelActive] =
        useState(false);
    const [studentDetailsPanelActive, setStudentDetailsPanelActive] =
        useState(false);
    const [groupAdditionPanelActive, setGroupAdditionPanelActive] =
        useState(false);

    return (
        <div className="students">
            <Logo />
            <Sidebar active={"students"} />
            <div className="students-container">
                <StudentList
                    openStudentAdd={setStudentAdditionPanelActive}
                    openStudentDetails={setStudentDetailsPanelActive}
                />
                <GroupList />
                <StudentImport />
            </div>

            {studentAdditionPanelActive ? (
                <StudentAdd close={setStudentAdditionPanelActive} />
            ) : (
                ""
            )}

            {studentDetailsPanelActive ? (
                <StudentDetails close={setStudentDetailsPanelActive} />
            ) : (
                ""
            )}
        </div>
    );
}
