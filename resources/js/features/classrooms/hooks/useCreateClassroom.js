import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useCreateClassroom(name, description) {
    const [data, loading, refresh, error] = usePost("/classroom", false, {
        name: name,
        description: description,
    });

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("CLASSROOM_CREATE_SUCCESS")));
        }
    }, [loading, error]);

    const createClassroom = async () => {
        refresh();
    };

    return { error, data, createClassroom };
}
