import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useEditReservation(lectureId, params) {
    const [data, loading, refresh, error] = usePatch(
        `/lecture/reserve/${lectureId}`,
        false,
        params
    );

    console.log(params);

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(
                actionSucceed(formatSuccess("RESERVATION_CREATE_SUCCESS"))
            );
        }
    }, [loading, error]);

    const editReservation = async () => {
        refresh();
    };

    return { error, data, editReservation };
}
