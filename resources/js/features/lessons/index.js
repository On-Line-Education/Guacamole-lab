import React, { useState } from "react";
import Sidebar from "../../components/Sidebar/Sidebar";
import Logo from "../../components/Logo/Logo";
import "./style.scss";
import LessonReserve from "./components/LessonReserve/LessonReserve";
import LessonReservedList from "./components/LessonReservedList/LessonReservedList";
import useGetAllReserved from "./hooks/useGetAllReserved";
import ReservationDetails from "./components/ReservationDetails/ReservationDetails";
import LessonCalendar from "./components/LessonCalendar/LessonCalendar";
import dayjs from "dayjs";

export default function LessonsView() {
    // View states

    const [reservationDetailsPanelState, setReservationDetailsPanelState] =
        useState(false);

    // Selected table row and calendar date

    const [selectedReservation, setSelectedReservation] = useState("");
    const [date, setDate] = useState(dayjs());

    // Queries

    const {
        data: reservedList,
        loading: reservedListLoading,
        error: reservedListLoadingError,
        refetch: reservedListRefetch,
    } = useGetAllReserved();

    return (
        <div className="lessons">
            <Logo />
            <Sidebar active={"lessons"} />
            <div className="lessons-container">
                <LessonCalendar
                    date={date}
                    setDate={setDate}
                    reservedList={reservedList}
                    loading={reservedListLoading}
                />
                <LessonReservedList
                    reservedList={reservedList}
                    loading={reservedListLoading}
                    selectedReservation={selectedReservation}
                    setSelectedReservation={setSelectedReservation}
                    setReservationDetailsPanelState={
                        setReservationDetailsPanelState
                    }
                    date={date}
                />
                <LessonReserve refetch={reservedListRefetch} />
            </div>

            {reservationDetailsPanelState ? (
                <ReservationDetails
                    reservation={selectedReservation}
                    refetch={reservedListRefetch}
                    close={setReservationDetailsPanelState}
                />
            ) : (
                ""
            )}
        </div>
    );
}
