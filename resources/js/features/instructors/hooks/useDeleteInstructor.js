import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useDelete from "../../../hooks/useDelete";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useDeleteInstructor(studentId) {
    const [data, loading, refresh, error] = useDelete(
        `/user/${studentId}`,
        false
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("STUDENT_DELETE_SUCCESS")));
        }
    }, [loading, error]);

    const deleteInstructor = async () => {
        refresh();
    };

    return { loading, error, data, deleteInstructor };
}
