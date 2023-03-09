import usePost from "../../../hooks/usePost";

export default function useCreateStudent(username, password) {
    const [data, loading, refresh, error] = usePost("/user", false, {
        username: username,
        password: password,
        role: "student",
    });

    const createUser = async () => {
        refresh();
    };

    return [error, data, createUser];
}
