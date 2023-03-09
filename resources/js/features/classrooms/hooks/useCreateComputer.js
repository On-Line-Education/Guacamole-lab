import usePost from "../../../hooks/usePost";

export default function useCreateComputer(classroomId, name, ip, mac, login) {
    const [data, loading, refresh, error] = usePost(
        `/classroom/${classroomId}/computer`,
        false,
        {
            name: name,
            ip: ip,
            mac: mac,
            login: login,
        }
    );

    const createComputer = async () => {
        refresh();
    };

    return [error, data, createComputer];
}
