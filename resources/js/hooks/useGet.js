import useFetch from "./useFetch";

export default function useGet(endpoint, start) {
    return useFetch({endpoint: endpoint, method:"GET", start: start});
}