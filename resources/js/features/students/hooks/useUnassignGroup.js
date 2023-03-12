import useGet from "../../../hooks/useGet";

export default function useUnassignGroup(groupId) {
    const [data, loading, refresh, error] = useGet(
        `/class/remove/${groupId}`,
        false
    );

    const unassign = async () => {
        refresh();
    };

    return { data, loading, error, unassign };
}
