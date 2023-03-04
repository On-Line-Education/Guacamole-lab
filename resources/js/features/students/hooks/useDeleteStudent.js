import useDelete from "../../../hooks/useDelete";

export default function useDeleteStudent(studentId) {
    const [data, loading, refresh, error] = useDelete(
        `/user/${studentId}`,
        false
    );

    const deleteStudent = async () => {
        refresh();
    };

    return { loading, error, deleteStudent };
}
