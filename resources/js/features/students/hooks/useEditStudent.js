import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useEditStudent(studentId, newUsername) {
    const [data, loading, refresh, error] = usePatch(
        `/user/${studentId}`,
        false,
        {
            attributes: {
                username: newUsername,
            },
        }
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("STUDENT_EDIT_SUCCESS")));
        }
    }, [loading, error]);

    const editStudent = async () => {
        refresh();
    };

    return { error, editStudent };
}
