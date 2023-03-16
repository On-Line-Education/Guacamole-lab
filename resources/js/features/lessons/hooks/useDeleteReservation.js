import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useDelete from "../../../hooks/useDelete";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useDeleteReservation(lessonId) {
    const [data, loading, refresh, error] = useDelete(
        `/lecture/reserve/${lessonId}}`,
        false
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("LESSON_DELETE_SUCCESS")));
        }
    }, [loading, error]);

    const deleteReservation = async () => {
        refresh();
    };

    return { loading, error, deleteReservation };
}
