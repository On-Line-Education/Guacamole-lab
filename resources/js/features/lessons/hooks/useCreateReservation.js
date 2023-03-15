import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useCreateReservation({
    instructorId,
    reservationClassroom,
    reservationGroup,
    reservationName,
    reservationDate,
    reservationStartTime,
    reservationEndTime,
}) {
    const [data, loading, refresh, error] = usePost("/lecture/reserve", false, {
        instructor_id: instructorId,
        name: reservationName,
        class_room_id: reservationClassroom.id,
        class_id: reservationGroup.id,
        start: `${reservationDate} ${reservationStartTime}`,
        end: `${reservationDate} ${reservationEndTime}`,
    });

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(
                actionSucceed(formatSuccess("RESERVATION_CREATE_SUCCESS"))
            );
        }
    }, [loading, error]);

    const createReservation = async () => {
        refresh();
    };

    return { error, data, createReservation };
}
