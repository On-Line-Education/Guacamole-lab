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
        getSelectedClassroomComputers,
    } = useGetStudentsFromGroup(selectedGroup.id);

    // Query for loading computer list, if user selected a classroom it fetches computers for that classroom
    useEffect(() => {
        if (selectedGroup) {
            getSelectedClassroomComputers();
        }
    }, [selectedGroup]);

    return (
        <div className="students">
            <Logo />
            <Sidebar active={"students"} />
            <div className="students-container">
                <StudentList
                    openStudentAdd={setStudentAdditionPanelState}
                    openStudentDetails={setStudentDetailsPanelState}
                    studentList={studentList}
                    loading={studentListLoading}
                    selectedGroup={selectedGroup}
                    selectedStudent={selectedStudent}
                    setSelectedStudent={setSelectedStudent}
                />
                <GroupList
                    openGroupAdd={setGroupAdditionPanelState}
                    groupList={groupList}
                    loading={groupListLoading}
                    setSelectedGroup={setSelectedGroup}
                    selectedGroup={selectedGroup}
                    refetch={refetchGroupList}
                />
                <StudentImport refetch={refetchGroupList} />
            </div>

            {studentAdditionPanelActive ? (
                <StudentAdd
                    refetch={getSelectedClassroomComputers}
                    group={selectedGroup}
                    close={setStudentAdditionPanelState}
                />
            ) : (
                ""
            )}

            {studentDetailsPanelActive ? (
                <StudentDetails
                    student={selectedStudent}
                    refetch={getSelectedClassroomComputers}
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
        </div>
    );
}
