import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useCreateReservation(
    name,
    instructorId,
    classroomId,
    groupId,
    start,
    end
) {
    const [data, loading, refresh, error] = usePost("/lecture/reserve", false, {
        name: name,
        instructor_id: instructorId,
        class_room_id: classroomId,
        class_id: groupId,
        start: start,
        end: end,
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
