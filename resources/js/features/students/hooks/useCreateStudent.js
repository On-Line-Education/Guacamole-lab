import { useEffect, useRef } from "react";
import usePost from "../../../hooks/usePost";
import { userCreationFailedAction } from "../../alert/state/alertActions";
import { useDispatch } from "react-redux";

export default function useCreateStudent(username, password) {
    const [data, loading, refresh, error] = usePost("/user", false, {
        username: username,
        password: password,
        role: "student",
    });
    const dispatch = useDispatch();
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current && !loading) {
            if (error.length > 0) {
                console.log(error);
                error.map((err) => {
                    dispatch(userCreationFailedAction(err));
                });
            }
        } else didMount.current = true;
    }, [loading, data, error]);

    const createUser = async () => {
        refresh();
    };

    return [error, data, createUser];
}
