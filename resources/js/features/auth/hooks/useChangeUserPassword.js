import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useChangeUserPassword(
    userId,
    oldPassword,
    newPassword
) {
    const [data, loading, refresh, error] = usePatch(
        `/user/${userId}/password`,
        false,
        {
            oldPassword: oldPassword,
            newPassword: newPassword,
        }
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("USER_PSWD_CHANGE_SUCCESS")));
        }
    }, [loading, error]);

    const changeUserPassword = async () => {
        refresh();
    };

    return { data, error, changeUserPassword };
}
