import { useEffect, useState, useRef } from "react";
import usePost from "../../../hooks/usePost";
import { useNavigate } from "react-router-dom";
import { loginAction } from "../state/authActions";
import { failedAction } from "../../alert/state/alertActions";
import { useDispatch } from "react-redux";

export default function useLogin(username, password) {
    const [data, loading, refresh, error] = usePost("/login", false, {
        username: username,
        password: password,
    });
    const [token, setToken] = useState();
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current && !loading) {
            if (error.length > 0) {
                console.log(error);
                error.map((err) => {
                    dispatch(failedAction(err));
                });
            } else {
                try {
                    setToken(data.token);
                    dispatch(loginAction(data));
                    if (data.user.role === "student") navigate("/connect");
                    if (
                        data.user.role === "teacher" ||
                        data.user.role === "admin"
                    )
                        navigate("/lessons");
                } catch (e) {
                    console.log(e);
                }
            }
        } else didMount.current = true;
    }, [login, loading, data, error]);

    const login = async () => {
        refresh();
    };

    return [token, error, login];
}
