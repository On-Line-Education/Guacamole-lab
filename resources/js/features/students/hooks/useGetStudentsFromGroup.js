import { useEffect, useState } from "react";
import useGet from "../../../hooks/useGet";

export default function useGetStudentsFromGroup(groupId) {
    const [data, loading, refresh, error] = useGet(
        `/class/${groupId}/users`,
        false
    );

    const getSelectedGroupStudents = async () => {
        refresh();
    };

    return {
        data,
        loading,
        error,
        getSelectedGroupStudents,
    };
}
