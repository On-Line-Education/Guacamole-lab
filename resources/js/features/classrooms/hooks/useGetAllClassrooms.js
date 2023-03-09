import useGet from "../../../hooks/useGet";

export default function useGetAllClassrooms() {
    const [data, loading, refresh, error] = useGet("/classroom/all", true);

    const refetch = async () => {
        refresh();
    };

    return { data: data, loading, error, refetch };
}
