import usePostFile from "../../../hooks/usePostFile";

export default function useImportComputers(file) {
    const [data, loading, refresh, error] = usePostFile("/user/import", file);

    const importComputers = async () => {
        refresh();
    };

    return [error, data, importComputers];
}
