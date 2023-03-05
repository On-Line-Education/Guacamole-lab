import useDelete from "../../../hooks/useDelete";

export default function useDeleteComputer(classroomId, computerId) {
    const [data, loading, refresh, error] = useDelete(
        `/classroom/${classroomId}/computer/${computerId}`,
        false
    );

    const deleteComputer = async () => {
        refresh();
    };

    return { loading, error, deleteComputer };
}
