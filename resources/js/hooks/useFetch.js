import { useState, useEffect } from "react";
import { useDispatch } from "react-redux";
import { formatError } from "../features/alert/services/formatError";
import { loginFailedAction } from "../features/alert/state/alertActions";

const useFetch = ({ endpoint, method, data, start }) => {
    const [result, setResult] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState([]);

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
            Authorization: localStorage.getItem("token")
                ? `Bearer ${localStorage.getItem("token")}`
                : {},
        };

        const requestOptions = {
            headers: headers,
            method: method,
        };

        if (data) {
            requestOptions.headers["Content-Type"] = "application/json";
            requestOptions["body"] = JSON.stringify(data);
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
                    dispatch(loginFailedAction(formatError(data.message)));
                }
            }
            setResult(data);
        } catch (err) {
            setError(err);
        }
        setLoading(false);
    };

    const refresh = () => {
        fetchData();
    };

    return [result, loading, refresh, error];
};

export default useFetch;
