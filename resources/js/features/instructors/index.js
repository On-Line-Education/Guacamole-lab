import React, { useState } from "react";
import Logo from "../../components/Logo/Logo";
import Sidebar from "../../components/Sidebar/Sidebar";
import InstructorAdd from "./components/InstructorAdd/InstructorAdd";
import InstructorList from "./components/InstructorList/InstructorList";
import useGetAllInstructors from "./hooks/useGetAllInstructors";
import "./style.scss";

export default function InstructorsView() {
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
                />
                <InstructorAdd refetch={refetchInstructorList} />
            </div>
        </div>
    );
}
