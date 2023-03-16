import useGet from "../../../hooks/useGet";

export default function useGetClassroomComputers(classroomId) {
    const [data, loading, refresh, error] = useGet(
        `/classroom/${classroomId}/computer/all`,
        false
    );

    const getClassroomComputers = async () => {
        refresh();
    };

    return { data, loading, error, getClassroomComputers };
}
