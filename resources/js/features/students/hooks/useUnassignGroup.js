import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useGet from "../../../hooks/useGet";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useUnassignGroup(groupId) {
    const [data, loading, refresh, error] = useGet(
        `/class/remove/${groupId}`,
        false
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("GROUP_UNASSIGN_SUCCESS")));
        }
    }, [loading, error]);

    const unassign = async () => {
        refresh();
    };

    return { data, loading, error, unassign };
}
