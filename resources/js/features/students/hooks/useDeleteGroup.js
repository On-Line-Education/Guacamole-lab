import { useEffect } from "react";
import { useDispatch } from "react-redux";
import useDelete from "../../../hooks/useDelete";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useDeleteGroup(groupId) {
    const [data, loading, refresh, error] = useDelete(
        `/class/${groupId}`,
        false
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("GROUP_DELETE_SUCCESS")));
        }
    }, [loading, error]);

    const deleteGroup = async () => {
        refresh();
    };

    return { loading, error, deleteGroup };
}
