import { useEffect, useRef } from "react";
import useGet from "../../../hooks/useGet";

export default function useGetAllGroups() {
    const [data, loading, refresh, error] = useGet("/class/all", true);
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current) {
            if (!loading && error.length < 1) {
                try {
                    console.log(data);
                } catch (e) {}
            }
        } else didMount.current = true;
    }, [refetch, loading, data, error]);

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
