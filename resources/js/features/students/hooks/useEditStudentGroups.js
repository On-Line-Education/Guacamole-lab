import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useEditStudentGroups(studentId, props) {
    const [data, loading, refresh, error] = usePatch(
        `/user/${studentId}/groups`,
        false,
        props
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(
                actionSucceed(formatSuccess("STUDENT_GROUP_EDIT_SUCCESS"))
            );
        }
    }, [loading, error]);

    const editStudentGroups = async () => {
        refresh();
    };

    return { error, editStudentGroups };
}
