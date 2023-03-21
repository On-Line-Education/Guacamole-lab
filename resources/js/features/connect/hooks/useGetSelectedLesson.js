import useGet from "../../../hooks/useGet";
import dayjs from "dayjs";

export default function useGetSelectedLesson(lessonId) {
    const [data, loading, refresh, error] = useGet(
        `/lecture/reserve/get/${lessonId}`,
        false
    );

    const formatData = (data) => {
        if (dayjs(data["start"]).isValid())
            data["start"] = dayjs(data["start"]).format("DD-MM HH:mm");

        if (dayjs(data["end"]).isValid())
            data["end"] = dayjs(data["end"]).format("DD-MM HH:mm");
    };

    if (data) {
        try {
            formatData(data.lecture);
        } catch (e) {}
    }

    const getLesson = async () => {
        refresh();
    };

    return { data, loading, error, getLesson };
}
