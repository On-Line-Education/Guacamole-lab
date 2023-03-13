import { useEffect } from "react";
import usePostFile from "../../../hooks/usePostFile";
import { useDispatch } from "react-redux";
import { formatSuccess } from "../../alert/services/formatSuccess";
import { actionSucceed } from "../../alert/state/alertActions";

export default function useImportComputers(file) {
    const [data, loading, refresh, error] = usePostFile("/user/import", file);

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("COMPUTER_IMPORT_SUCCESS")));
        }
    }, [loading, error]);

    const importComputers = async () => {
        refresh();
    };

    return [error, data, importComputers];
}
