import useGet from "../../../hooks/useGet";

export default function useGetAllStudents() {
    const [data, loading, refresh, error] = useGet(
        "/user/all?system-only=true",
        true
    );

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
