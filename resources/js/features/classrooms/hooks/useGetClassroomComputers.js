import { useEffect, useRef } from "react";
import useGet from "../../../hooks/useGet";

export default function useGetClassroomComputers(classroomId) {
    const [data, loading, refresh, error] = useGet(
        `/classroom/${classroomId}/computer/all`,
        false
    );
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current) {
            if (!loading && error.length < 1) {
                try {
                    console.log(data);
                } catch (e) {}
            }
        } else didMount.current = true;
    }, [getClassroomComputers, loading, data, error]);

    const getClassroomComputers = async () => {
        refresh();
    };

    return { data, loading, error, getClassroomComputers };
}
