import { useState, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import { formatError } from "../features/alert/services/formatError";
import {
    failedAction,
    userUnauthenticated,
} from "../features/alert/state/alertActions";

const useFetch = ({ endpoint, method, body, start }) => {
    const [result, setResult] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState([]);
    const token = useSelector((state) => state.auth.token);

    const dispatch = useDispatch();
    const navigate = useNavigate();

    useEffect(() => {
        if (start) fetchData();
    }, [fetchData, start]);

    const fetchData = async () => {
        setLoading(true);
        const staticURL = `${"http://localhost:8888/api"}${endpoint}`;
        const headers = {
            Accept: "application/json",
            Authorization: token ? `Bearer ${token}` : {},
        };

        const requestOptions = {
            headers: headers,
            method: method,
        };

        if (body) {
            requestOptions.headers["Content-Type"] = "application/json";
            requestOptions["body"] = JSON.stringify(body);
        }

        try {
            const response = await fetch(staticURL, requestOptions);
            const data = await response.json();

            if (!response.ok) {
                console.log(response);
                if (response.status === 401 || response.status === 403) {
                    dispatch(userUnauthenticated());
                    navigate("/login");
                    return;
                }

                // Api returns an array of errors. This piece of code formats every returned error message and send it to redux store
                if (data.errors) {
                    console.log(data);
                    Object.values(data.errors).forEach((error) => {
                        dispatch(failedAction(formatError(error[0])));
                        setError((prevErrors) => [
                            ...prevErrors,
                            formatError(error[0]),
                        ]);
                    });
                } else {
                    console.log(data.message);
                    dispatch(failedAction(formatError(data.message)));
                    setError(formatError(data.message));
                }
            } else {
                // if there are no errors return data
                setResult(data.body);
            }
        } catch (err) {
            setError(err);
        }
        setLoading(false);
    };

    const refresh = () => {
        console.log(token);
        setError("");
        fetchData();
    };

    return [result, loading, refresh, error];
};

export default useFetch;
