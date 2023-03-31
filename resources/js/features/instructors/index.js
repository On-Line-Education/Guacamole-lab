import React, { useState } from "react";
import Logo from "../../components/Logo/Logo";
import Sidebar from "../../components/Sidebar/Sidebar";
import InstructorAdd from "./components/InstructorAdd/InstructorAdd";
import InstructorChangePassword from "./components/InstructorChangePassword/InstructorChangePassword";
import InstructorList from "./components/InstructorList/InstructorList";
import useGetAllInstructors from "./hooks/useGetAllInstructors";
import "./style.scss";

export default function InstructorsView() {
    // View state

    const [
        instructorChangePasswordPanelState,
        setInstructorChangePasswordPanelState,
    ] = useState(false);

    // Get All instructors hook declaration
    const {
        data: instructorList,
        loading: instructorListLoading,
        refetch: refetchInstructorList,
    } = useGetAllInstructors();

    //Selected table rows state

    const [selectedInstructor, setSelectedInstructor] = useState("");

    return (
        <div className="instructors">
            <Logo />
            <Sidebar active={"instructors"} />
            <div className="instructors-container">
                <InstructorList
                    instructorList={instructorList}
                    loading={instructorListLoading}
                    selectedInstructor={selectedInstructor}
                    setSelectedInstructor={setSelectedInstructor}
                    refetch={refetchInstructorList}
                    setInstructorChangePasswordPanelState={
                        setInstructorChangePasswordPanelState
                    }
                />
                <InstructorAdd refetch={refetchInstructorList} />
            </div>
            {instructorChangePasswordPanelState ? (
                <InstructorChangePassword
                    selectedInstructor={selectedInstructor}
                    refetch={refetchInstructorList}
                    setInstructorChangePasswordPanelState={
                        setInstructorChangePasswordPanelState
                    }
                />
            ) : (
                ""
            )}
        </div>
    );
}
