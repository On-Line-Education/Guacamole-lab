import useGet from "../../../hooks/useGet";
import dayjs from "dayjs";

export default function useGetAllReserved() {
    const [data, loading, refresh, error] = useGet("/lecture", true);

    const formatData = (data) => {
        if (dayjs(data["start"]).isValid())
            data["start"] = dayjs(data["start"]).format("DD-MM HH:mm");

        if (dayjs(data["end"]).isValid())
            data["end"] = dayjs(data["end"]).format("DD-MM HH:mm");
    };

    if (data) {
        try {
            data.lectures.map((lecture) => {
                formatData(lecture);
            });
        } catch (e) {
            console.log(e);
        }
    }

    const refetch = async () => {
        refresh();
    };

    return { data, loading, error, refetch };
}
