import useGet from "../../../hooks/useGet";

export default function useGetAllStudents() {
    const [data, loading, refresh, error] = useGet(
        "/user/all?system-only=true",
        true
    );

    console.log(data);

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
