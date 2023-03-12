import usePost from "../../../hooks/usePost";

export default function useEditComputer(
    classroomId,
    computerId,
    newName,
    newIp,
    newMac
) {
    const [data, loading, refresh, error] = usePost(
        `/classroom/${classroomId}/computer/${computerId}`,
        false,
        {
            name: newName,
            ip: newIp,
            mac: newMac,
        }
    );

    const createClassroom = async () => {
        refresh();
    };

    return [error, data, createClassroom];
}
