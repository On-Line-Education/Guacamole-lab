import usePostFile from "../../../hooks/usePostFile";

export default function useImportStudents(file) {
    const [data, loading, refresh, error] = usePostFile("/user/import", file);

    const importStudents = async () => {
        console.log(file);
        refresh();
    };

    return [error, data, importStudents];
}
