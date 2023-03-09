import usePost from "../../../hooks/usePost";

export default function useCreateGroup(name) {
    const [data, loading, refresh, error] = usePost("/class", false, {
        name: name,
    });

    const createGroup = async () => {
        refresh();
    };

    return [error, data, createGroup];
}
