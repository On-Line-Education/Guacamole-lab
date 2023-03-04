import { useState, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { formatError } from "../features/alert/services/formatError";
import { loginFailedAction } from "../features/alert/state/alertActions";

const useFetch = ({ endpoint, method, body, start }) => {
    const [result, setResult] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState([]);
    const token = useSelector((state) => state.auth.token);

    const dispatch = useDispatch();

    useEffect(() => {
        if (start) fetchData();
    }, [fetchData, start]);

    const fetchData = async () => {
        if (loading) return;

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

            console.log(data);
            if (!response.ok) {
                console.log(data);
                // Api returns an array of errors. This piece of code formats every returned error message and sends it to state variable
                if (data.errors) {
                    Object.values(data.errors).forEach((error) => {
                        setError((prevErrors) => [
                            ...prevErrors,
                            formatError(error[0]),
                        ]);
                        dispatch(loginFailedAction(formatError(error[0])));
                    });
                } else {
                    setError(data.message);
                    dispatch(loginFailedAction(formatError(data.message)));
                }
            } else {
                console.log(data);
                setResult(data.body);
            }
        } catch (err) {
            setError(err);
        }
        setLoading(false);
    };

    const refresh = () => {
        console.log(token);
        fetchData();
    };

    return [result, loading, refresh, error];
};

export default useFetch;
