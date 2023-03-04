import { useEffect, useState, useRef } from "react";
import usePost from "../../../hooks/usePost";
import { useNavigate } from "react-router-dom";
import { loginAction } from "../state/authActions";
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
        if (didMount.current) {
            if (!loading && error.length < 1) {
                try {
                    console.log("logging");
                    setToken(data.token);
                    dispatch(loginAction(data));
                    navigate("/home");
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
