import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useDelete from "../../../hooks/useDelete";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useDeleteClassroom(classroomId) {
    const [data, loading, refresh, error] = useDelete(
        `/classroom/${classroomId}`,
        false
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("CLASSROOM_DELETE_SUCCESS")));
        }
    }, [loading, error]);

    const deleteClassroom = async () => {
        refresh();
    };

    return { loading, error, data, deleteClassroom };
}
