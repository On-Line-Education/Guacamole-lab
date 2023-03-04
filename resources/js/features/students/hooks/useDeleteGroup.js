import useDelete from "../../../hooks/useDelete";

export default function useDeleteGroup(groupId) {
    const [data, loading, refresh, error] = useDelete(
        `/class/${groupId}`,
        false
    );

    const deleteGroup = async () => {
        refresh();
    };

    return { loading, error, deleteGroup };
}
