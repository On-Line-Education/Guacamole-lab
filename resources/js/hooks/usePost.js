import useFetch from "./useFetch";

export default function usePost(endpoint, start, data) {
    return useFetch({
        endpoint: endpoint,
        method: "POST",
        start: start,
        body: data,
    });
}
