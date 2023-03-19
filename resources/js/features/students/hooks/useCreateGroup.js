import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePost from "../../../hooks/usePost";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useCreateGroup(name) {
    const [data, loading, refresh, error] = usePost("/class", false, {
        name: name,
    });

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            console.log("success");
            dispatch(actionSucceed(formatSuccess("GROUP_CREATE_SUCCESS")));
        }
    }, [loading, error]);

    const createGroup = async () => {
        refresh();
    };

    return { error, data, createGroup };
}
