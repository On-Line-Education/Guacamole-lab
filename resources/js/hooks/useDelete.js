import useFetch from "./useFetch";

export default function useDelete(endpoint, start) {
    return useFetch({ endpoint: endpoint, method: "DELETE", start: start });
}
