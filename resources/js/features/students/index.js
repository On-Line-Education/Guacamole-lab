import React, { useState, useEffect } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./style.scss";
import StudentList from "./components/StudentList/StudentList";
import Logo from "../../components/Logo/Logo";
import StudentAdd from "./components/StudentAdd/StudentAdd";
import GroupList from "./components/GroupList/GroupList";
import StudentDetails from "./components/StudentDetails/StudentDetails";
import StudentImport from "./components/StudentImport/StudentImport";
import useGetAllGroups from "./hooks/useGetAllGroups";
import GroupAdd from "./components/GroupAdd/GroupAdd";
import useGetStudentsFromGroup from "./hooks/useGetStudentsFromGroup";
import StudentChangePassword from "./components/StudentChangePassword/StudentChangePassword";

export default function StudentsView() {
    //Selected table rows state

    const [selectedStudent, setSelectedStudent] = useState("");
    const [selectedGroup, setSelectedGroup] = useState("");

    // View states

    const [studentAdditionPanelActive, setStudentAdditionPanelState] =
        useState(false);
    const [studentDetailsPanelActive, setStudentDetailsPanelState] =
        useState(false);
    const [groupAdditionPanelActive, setGroupAdditionPanelState] =
        useState(false);
    const [
        studentChangePasswordPanelActive,
        setStudentChangePasswordPanelState,
    ] = useState(false);

    // Get All Groups hook declaration

    const {
        data: groupList,
        loading: groupListLoading,
        error: groupListLoadingError,
        refetch: refetchGroupList,
    } = useGetAllGroups();

    // Get Students From Group hook declaration

    const {
        data: studentList,
        loading: studentListLoading,
        error: studentListLoadingError,
        getSelectedGroupStudents,
    } = useGetStudentsFromGroup(selectedGroup.id);

    // Query for loading computer list, if user selected a classroom it fetches computers for that classroom
    useEffect(() => {
        if (selectedGroup) {
            getSelectedGroupStudents();
        }
    }, [selectedGroup]);

    return (
        <div className="students">
            <Logo />
            <Sidebar active={"students"} />
            <div className="students-container">
                <GroupList
                    openGroupAdd={setGroupAdditionPanelState}
                    groupList={groupList}
                    loading={groupListLoading}
                    setSelectedGroup={setSelectedGroup}
                    selectedGroup={selectedGroup}
                    refetch={refetchGroupList}
                />
                <StudentList
                    openStudentAdd={setStudentAdditionPanelState}
                    openStudentDetails={setStudentDetailsPanelState}
                    openStudentChangePasswordPanelState={
                        setStudentChangePasswordPanelState
                    }
                    studentList={studentList}
                    loading={studentListLoading}
                    selectedGroup={selectedGroup}
                    selectedStudent={selectedStudent}
                    setSelectedStudent={setSelectedStudent}
                />
                <StudentImport refetch={refetchGroupList} />
            </div>

            {studentAdditionPanelActive ? (
                <StudentAdd
                    refetch={getSelectedGroupStudents}
                    group={selectedGroup}
                    close={setStudentAdditionPanelState}
                />
            ) : (
                ""
            )}

            {studentDetailsPanelActive ? (
                <StudentDetails
                    student={selectedStudent}
                    refetch={getSelectedGroupStudents}
                    setStudentDetailsPanelState={setStudentDetailsPanelState}
                />
            ) : (
                ""
            )}

            {groupAdditionPanelActive ? (
                <GroupAdd
                    close={setGroupAdditionPanelState}
                    refetch={refetchGroupList}
                />
            ) : (
                ""
            )}

            {studentChangePasswordPanelActive ? (
                <StudentChangePassword
                    selectedStudent={selectedStudent}
                    setStudentChangePasswordPanelState={
                        setStudentChangePasswordPanelState
                    }
                    refetch={getSelectedGroupStudents}
                />
            ) : (
                ""
            )}
        </div>
    );
}
