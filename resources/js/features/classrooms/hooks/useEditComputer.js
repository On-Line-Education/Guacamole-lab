import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePatch from "../../../hooks/usePatch";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useEditComputer(classroomId, computerId, props) {
    const [data, loading, refresh, error] = usePatch(
        `/classroom/${classroomId}/computer/${computerId}`,
        false,
        props
    );

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("COMPUTER_EDIT_SUCCESS")));
        }
    }, [loading, error]);

    const editComputer = async () => {
        refresh();
    };

    return { error, data, editComputer };
}
