import React, { useEffect, useState } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./style.scss";
import ClassroomList from "./components/ClassroomList/ClassroomList";
import Logo from "../../components/Logo/Logo";
import ClassroomAdd from "./components/ClassroomAdd/ClassroomAdd";
import useGetAllClassrooms from "./hooks/useGetAllClassrooms";
import ComputerList from "./components/ComputerList/ComputerList";
import useGetClassroomComputers from "./hooks/useGetClassroomComputers";
import ComputerAdd from "./components/ComputerAdd/ComputerAdd";
import ComputerDetails from "./components/ComputerDetails/ComputerDetails";
import ComputerImport from "./components/ComputerImport/ComputerImport";

export default function ClassroomsView() {
    // View states

    const [classroomAdditionPanelState, setClassroomAdditionPanelState] =
        useState(false);
    const [computerDetailsPanelState, setComputerDetailsPanelState] =
        useState(false);
    const [computerAdditionPanelState, setComputerAdditionPanelState] =
        useState(false);

    // Selected table rows state

    const [selectedClassroom, setSelectedClassroom] = useState("");
    const [selectedComputer, setSelectedComputer] = useState("");

    // Queries

    const {
        data: classroomList,
        loading: classroomListLoading,
        error: classroomListLoadingError,
        refetch: classroomListRefetch,
    } = useGetAllClassrooms();

    const {
        data: computerList,
        loading: computerListLoading,
        error: computerListLoadingError,
        getClassroomComputers,
    } = useGetClassroomComputers(selectedClassroom.id);

    // Query for loading computer list, if user selected a classroom it fetches computers for that classroom
    useEffect(() => {
        if (selectedClassroom) {
            getClassroomComputers();
        }
    }, [selectedClassroom]);

    return (
        <div className="classrooms">
            <Logo />
            <Sidebar active={"classrooms"} />
            <div className="classrooms-container">
                <ClassroomList
                    classroomList={classroomList}
                    loading={classroomListLoading}
                    refetch={classroomListRefetch}
                    selectedClassroom={selectedClassroom}
                    setSelectedClassroom={setSelectedClassroom}
                    setClassroomAdditionPanelState={
                        setClassroomAdditionPanelState
                    }
                />
                <ComputerList
                    computerList={selectedClassroom ? computerList : undefined}
                    loading={computerListLoading}
                    selectedClassroom={selectedClassroom}
                    selectedComputer={selectedComputer}
                    setSelectedComputer={setSelectedComputer}
                    openComputerDetails={setComputerDetailsPanelState}
                    openComputerAdd={setComputerAdditionPanelState}
                />
                <ComputerImport refetch={classroomListRefetch} />
            </div>

            {classroomAdditionPanelState ? (
                <ClassroomAdd
                    refetch={classroomListRefetch}
                    setClassroomAdditionPanelState={
                        setClassroomAdditionPanelState
                    }
                />
            ) : (
                ""
            )}

            {computerDetailsPanelState ? (
                <ComputerDetails
                    classroom={selectedClassroom}
                    computer={selectedComputer}
                    refetch={getClassroomComputers}
                    setComputerDetailsPanelState={setComputerDetailsPanelState}
                />
            ) : (
                ""
            )}

            {computerAdditionPanelState ? (
                <ComputerAdd
                    classroom={selectedClassroom}
                    refetch={getClassroomComputers}
                    setComputerAdditionPanelState={
                        setComputerAdditionPanelState
                    }
                />
            ) : (
                ""
            )}
        </div>
    );
}
