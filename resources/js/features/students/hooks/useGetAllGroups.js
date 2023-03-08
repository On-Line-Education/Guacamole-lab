import useGet from "../../../hooks/useGet";

export default function useGetAllGroups() {
    const [data, loading, refresh, error] = useGet("/class/all", true);

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
