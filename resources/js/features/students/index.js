import React, { useState } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./assets/style.scss";
import StudentList from "./components/StudentList/StudentList";
import Logo from "../../components/Logo/Logo";
import StudentAdd from "./components/StudentAdd/StudentAdd";
import GroupList from "./components/GroupList/GroupList";
import StudentDetails from "./components/StudentDetails/StudentDetails";
import StudentImport from "./components/StudentImport/StudentImport";
import useGetAllStudents from "./hooks/useGetAllStudents";
import useGetAllGroups from "./hooks/useGetAllGroups";
import GroupAdd from "./components/GroupAdd/GroupAdd";

export default function StudentsView() {
    // View states

    const [studentAdditionPanelActive, setStudentAdditionPanelActive] =
        useState(false);
    const [studentDetailsPanelActive, setStudentDetailsPanelActive] =
        useState(false);
    const [groupAdditionPanelActive, setGroupAdditionPanelActive] =
        useState(false);

    //Queries

    const {
        data: studentList,
        loading: studentListLoading,
        error: studentListLoadingError,
        refetch: refreshStudentList,
    } = useGetAllStudents();

    const {
        data: groupList,
        loading: groupListLoading,
        error: groupListLoadingError,
        refetch: refreshGroupList,
    } = useGetAllGroups();

    //Selected table rows state

    const [selectedStudent, setSelectedStudent] = useState("");
    const [selectedGroup, setSelectedGroup] = useState("");

    const refetchAll = () => {
        refreshStudentList();
        refreshGroupList();
    };

    return (
        <div className="students">
            <Logo />
            <Sidebar active={"students"} />
            <div className="students-container">
                <StudentList
                    openStudentAdd={setStudentAdditionPanelActive}
                    openStudentDetails={setStudentDetailsPanelActive}
                    studentList={studentList}
                    loading={studentListLoading}
                    setSelectedStudent={setSelectedStudent}
                    selectedStudent={selectedStudent}
                />
                <GroupList
                    openGroupAdd={setGroupAdditionPanelActive}
                    groupList={groupList}
                    loading={groupListLoading}
                    setSelectedGroup={setSelectedGroup}
                    selectedGroup={selectedGroup}
                />
                <StudentImport />
            </div>

            {studentAdditionPanelActive ? (
                <StudentAdd
                    close={setStudentAdditionPanelActive}
                    refetch={refetchAll}
                />
            ) : (
                ""
            )}

            {studentDetailsPanelActive ? (
                <StudentDetails
                    student={selectedStudent}
                    close={setStudentDetailsPanelActive}
                />
            ) : (
                ""
            )}

            {groupAdditionPanelActive ? (
                <GroupAdd
                    close={setGroupAdditionPanelActive}
                    refetch={refetchAll}
                />
            ) : (
                ""
            )}
        </div>
    );
}
