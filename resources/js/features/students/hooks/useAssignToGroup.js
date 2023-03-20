import useGet from "../../../hooks/useGet";

export default function useAssignToGroup(groupId, userId) {
    const [data, loading, refresh, error] = useGet(
        `/class/${groupId}/add/${userId}`,
        false
    );

    const assignToGroup = async () => {
        refresh();
    };

    return { data, loading, error, assignToGroup };
}
