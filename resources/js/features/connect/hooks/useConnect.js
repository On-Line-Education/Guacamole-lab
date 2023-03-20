import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useGet from "../../../hooks/useGet";

export default function useConnect(lessonId) {
    const [data, loading, refresh, error] = useGet(
        `/lecture/join/${lessonId}`,
        false
    );

    const dispatch = useDispatch();

    console.log(data);

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
