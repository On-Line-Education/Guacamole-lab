import { useEffect } from "react";
import { useDispatch } from "react-redux";
import usePostFile from "../../../hooks/usePostFile";
import { actionSucceed } from "../../alert/state/alertActions";
import { formatSuccess } from "../../alert/services/formatSuccess";

export default function useImportStudents(file) {
    const [data, loading, refresh, error] = usePostFile("/user/import", file);

    const dispatch = useDispatch();

    useEffect(() => {
        if (!loading && !error.length > 0) {
            dispatch(actionSucceed(formatSuccess("STUDENT_IMPORT_SUCCESS")));
        }
    }, [loading, error]);

    const importStudents = async () => {
        console.log(file);
        refresh();
    };

    return [error, data, importStudents];
}
