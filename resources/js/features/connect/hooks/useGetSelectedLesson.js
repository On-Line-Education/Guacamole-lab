import useGet from "../../../hooks/useGet";
import dayjs from "dayjs";

export default function useGetSelectedLesson(lessonId) {
    const [data, loading, refresh, error] = useGet(
        `/lecture/reserve/get/${lessonId}`,
        false
    );
    const formatData = (data) => {
        data["start"] = dayjs(data["start"]).format("DD-MM HH:mm");
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
