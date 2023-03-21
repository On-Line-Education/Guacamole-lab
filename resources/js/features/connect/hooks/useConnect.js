import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useGet from "../../../hooks/useGet";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useConnect(lessonId) {
    const [data, loading, refresh, error] = useGet(
        `/lecture/join/${lessonId}`,
        false
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("CONNECT_SUCCESS")));
        }
    }, [loading, error]);

    useEffect(() => {
        if (!loading && data.lecture) {
            window.open(data.lecture, "_blank");
        }
    }, [data]);

    const connect = async () => {
        refresh();
    };

    return { data, loading, error, connect };
}
