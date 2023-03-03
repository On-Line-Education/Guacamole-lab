import { useEffect, useRef } from "react";
import usePost from "../../../hooks/usePost";

export default function useCreateStudent(username, password) {
    const [data, loading, refresh, error] = usePost("/user", false, {
        username: username,
        password: password,
    });
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current) {
            if (!loading && error.length < 1) {
                try {
                    setToken(data.token);
                    dispatch(loginAction(data));
                    navigate("/home");
                } catch (e) {
                    console.log(e);
                }
            }
        } else didMount.current = true;
    }, [createStudent, loading, data, error]);

    const createStudent = async () => {
        refresh();
    };

    return [loading, error, createStudent];
}
