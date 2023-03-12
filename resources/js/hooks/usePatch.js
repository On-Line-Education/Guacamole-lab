import useFetch from "./useFetch";

export default function usePatch(endpoint, start, data) {
    return useFetch({
        endpoint: endpoint,
        method: "PATCH",
        start: start,
        body: data,
    });
}
