import { useEffect, useRef } from "react";
import usePost from "../../../hooks/usePost";
import { classroomCreationFailedAction } from "../../alert/state/alertActions";
import { useDispatch } from "react-redux";

export default function useCreateComputer(classroomId, name, ip, mac, login) {
    const [data, loading, refresh, error] = usePost(
        `/classroom/${classroomId}/computer`,
        false,
        {
            name: name,
            ip: ip,
            mac: mac,
            login: login,
        }
    );
    const dispatch = useDispatch();
    const didMount = useRef(false);

    useEffect(() => {
        if (didMount.current && !loading) {
            if (error.length > 0) {
                console.log(error);
                error.map((err) => {
                    dispatch(classroomCreationFailedAction(err));
                });
            }
        } else didMount.current = true;
    }, [loading, data, error]);

    const createComputer = async () => {
        refresh();
    };

    return [error, data, createComputer];
}
