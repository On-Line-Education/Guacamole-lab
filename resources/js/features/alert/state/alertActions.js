let nextId = 0;

export function failedAction(error) {
    return {
        type: "ACTION_FAILED",
        payload: { ...error, type: "error", id: nextId++ },
    };
}

export function actionSucceed(success) {
    return {
        type: "ACTION_SUCCEED",
        payload: { ...success, type: "success", id: nextId++ },
    };
}

export function deleteError(id) {
    return {
        type: "DELETE_MESSAGE",
        payload: id,
    };
}
