import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useEditComputer(
    classroomId,
    computerId,
    newName,
    newIp,
    newMac
) {
    const [data, loading, refresh, error] = usePost(
        `/classroom/${classroomId}/computer/${computerId}`,
        false,
        {
            name: newName,
            ip: newIp,
            mac: newMac,
        }
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("COMPUTER_EDIT_SUCCESS")));
        }
    }, [loading, error]);

    const createClassroom = async () => {
        refresh();
    };

    return [error, data, createClassroom];
}
