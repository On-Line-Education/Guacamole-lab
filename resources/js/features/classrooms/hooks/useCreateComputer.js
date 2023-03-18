import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useCreateComputer(
    classroomId,
    name,
    ip,
    mac,
    instructor
) {
    const [data, loading, refresh, error] = usePost(
        `/classroom/${classroomId}/computer`,
        false,
        {
            name: name,
            ip: ip,
            mac: mac,
            login: "placeholder",
            instructor: instructor,
        }
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("COMPUTER_CREATE_SUCCESS")));
        }
    }, [loading, error]);

    const createComputer = async () => {
        refresh();
    };

    return { error, data, createComputer };
}
