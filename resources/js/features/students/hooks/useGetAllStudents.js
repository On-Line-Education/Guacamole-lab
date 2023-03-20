import { useEffect, useState } from "react";
import useGet from "../../../hooks/useGet";

export default function useGetAllStudents() {
    const [data, loading, refresh, error] = useGet(
        "/user/all?system-only=true",
        true
    );

    let userData = {};

    if (data) {
        userData = data.filter((obj) => {
            return obj.role == "student";
        });
    }

    const refetch = async () => {
        refresh();
    };

    return { data: userData ? userData : data, loading, error, refetch };
}
