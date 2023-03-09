import useGet from "../../../hooks/useGet";

export default function useGetAllGSessions() {
    const [data, loading, refresh, error] = useGet(
        "/classroom/all/with-instructors",
        true
    );

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
