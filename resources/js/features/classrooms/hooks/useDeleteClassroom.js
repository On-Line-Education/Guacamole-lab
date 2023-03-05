import useDelete from "../../../hooks/useDelete";

export default function useDeleteClassroom(classroomId) {
    const [data, loading, refresh, error] = useDelete(
        `/classroom/${classroomId}`,
        false
    );

    const deleteClassroom = async () => {
        refresh();
    };

    return { loading, error, deleteClassroom };
}
