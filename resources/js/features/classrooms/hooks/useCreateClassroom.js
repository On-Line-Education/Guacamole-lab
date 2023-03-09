import usePost from "../../../hooks/usePost";

export default function useCreateClassroom(name, description) {
    const [data, loading, refresh, error] = usePost("/classroom", false, {
        name: name,
        description: description,
    });

    const createClassroom = async () => {
        refresh();
    };

    return [error, data, createClassroom];
}
