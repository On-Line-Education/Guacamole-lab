import usePatch from "../../../hooks/usePatch";

export default function useEditStudent(studentId, newUsername) {
    const [data, loading, refresh, error] = usePatch(
        `/user/${studentId}`,
        false,
        {
            attributes: {
                username: newUsername,
            },
        }
    );

    const editStudent = async () => {
        refresh();
    };

    return { error, editStudent };
}
