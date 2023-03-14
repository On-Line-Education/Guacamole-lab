import React, { useEffect, useState } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import "./assets/style.scss";
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

    const [classroomAdditionPanelActive, setClassroomAdditionPanelActive] =
        useState(false);
    const [computerDetailsPanelActive, setComputerDetailsPanelActive] =
        useState(false);
    const [computerAdditionPanelActive, setComputerAdditionPanelActive] =
        useState(false);

    // Selected table rows state

    const [selectedClassroom, setSelectedClassroom] = useState("");
    const [selectedComputer, setSelectedComputer] = useState("");

    // Queries

    const {
        data: classroomList,
        loading: classroomListLoading,
        error: classroomListLoadingError,
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
                    openClassroomAdd={setClassroomAdditionPanelActive}
                    classroomList={classroomList}
                    loading={classroomListLoading}
                    setSelectedClassroom={setSelectedClassroom}
                    selectedClassroom={selectedClassroom}
                />
                <ComputerList
                    openComputerAdd={setComputerAdditionPanelActive}
                    openComputerDetails={setComputerDetailsPanelActive}
                    computerList={computerList}
                    loading={computerListLoading}
                    setSelectedComputer={setSelectedComputer}
                    selectedClassroom={selectedClassroom}
                    selectedComputer={selectedComputer}
                />
                <ComputerImport />
            </div>

            {classroomAdditionPanelActive ? (
                <ClassroomAdd close={setClassroomAdditionPanelActive} />
            ) : (
                ""
            )}

            {computerDetailsPanelActive ? (
                <ComputerDetails
                    classroom={selectedClassroom}
                    computer={selectedComputer}
                    close={setComputerDetailsPanelActive}
                />
            ) : (
                ""
            )}

            {computerAdditionPanelActive ? (
                <ComputerAdd
                    classroom={selectedClassroom}
                    close={setComputerAdditionPanelActive}
                />
            ) : (
                ""
            )}
        </div>
    );
}
