import React, { useState } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import Logo from "../../components/Logo/Logo";
import "./assets/style.scss";
import LessonReserve from "./components/LessonReserve/LessonReserve";
import LessonReservedList from "./components/LessonReservedList/LessonReservedList";
import useGetAllReserved from "./hooks/useGetAllReserved";

export default function LessonsView() {
    // View states

    const [reservationDetailsPanelState, setReservationDetailsPanelState] =
        useState(false);

    // Selected table row

    const [selectedReservation, setSelectedReservation] = useState("");

    // Queries

    const {
        data: reservedList,
        loading: reservedListLoading,
        error: reservedListLoadingError,
        refetch: reservedListRefetch,
    } = useGetAllReserved();

    // Refetch logic

    return (
        <div className="lessons">
            <Logo />
            <Sidebar active={"lessons"} />
            <div className="lessons-container">
                <LessonReservedList
                    reservedList={reservedList}
                    loading={reservedListLoading}
                    selectedReservation={selectedReservation}
                    setSelectedReservation={setSelectedReservation}
                    setReservationDetailsPanelState={
                        setReservationDetailsPanelState
                    }
                />
                <LessonReserve refetch={reservedListRefetch} />
            </div>
        </div>
    );
}
