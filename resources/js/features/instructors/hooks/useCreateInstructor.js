import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useCreateInstructor(username, password) {
    const [data, loading, refresh, error] = usePost("/user", false, {
        username: username,
        password: password,
        role: "instructor",
    });

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("INSTRUCTOR_CREATE_SUCCESS")));
        }
    }, [loading, error]);

    const createInstructor = async () => {
        refresh();
    };

    return { error, data, createInstructor };
}
