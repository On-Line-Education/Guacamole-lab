import useGet from "../../../hooks/useGet";

export default function useGetAllReserved() {
    const [data, loading, refresh, error] = useGet("/lecture", true);

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
