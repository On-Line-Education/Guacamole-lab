import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useChangeInstructorsPassword(
    instructorId,
    newPassword
) {
    const [data, loading, refresh, error] = usePatch(
        `/user/${instructorId}`,
        false,
        {
            password: newPassword,
        }
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(
                actionSucceed(formatSuccess("INSTRUCTOR_PSWD_CHANGE_SUCCESS"))
            );
        }
    }, [loading, error]);

    const changeInstructorsPassword = async () => {
        refresh();
    };

    return { data, error, changeInstructorsPassword };
}
