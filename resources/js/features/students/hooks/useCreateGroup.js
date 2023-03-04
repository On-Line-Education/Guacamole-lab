import { useEffect, useRef } from "react";
import usePost from "../../../hooks/usePost";
import { groupCreationFailedAction } from "../../alert/state/alertActions";
import { useDispatch } from "react-redux";

export default function useCreateGroup(name) {
    const [data, loading, refresh, error] = usePost("/class", false, {
        name: name,
    });
    const dispatch = useDispatch();
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current && !loading) {
            if (error.length > 0) {
                console.log(error);
                error.map((err) => {
                    dispatch(groupCreationFailedAction(err));
                });
            }
        } else didMount.current = true;
    }, [loading, data, error]);

    const createGroup = async () => {
        refresh();
    };

    return [error, data, createGroup];
}
