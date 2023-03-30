import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useChangeStudentsPassword(studentId, newPassword) {
    const [data, loading, refresh, error] = usePatch(
        `/user/${studentId}`,
        false,
        {
            password: newPassword,
        }
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(
                actionSucceed(formatSuccess("STUDENT_PSWD_CHANGE_SUCCESS"))
            );
        }
    }, [loading, error]);

    const changeStudentsPassword = async () => {
        refresh();
    };

    return { data, error, changeStudentsPassword };
}
