let nextId = 0;

export function failedAction(error) {
    console.log(error);
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

export function connectionError() {
    return {
        type: "ACTION_FAILED",
        payload: {
            title: "Błąd połączenia",
            message: "Spróbuj ponownie później",
            type: "error",
            id: nextId++,
        },
    };
}

export function userUnauthenticated() {
    return {
        type: "ACTION_FAILED",
        payload: {
            title: "Sesja wygasła",
            message: "Zaloguj się ponownie",
            type: "error",
            id: nextId++,
        },
    };
}

export function deleteError(id) {
    return {
        type: "DELETE_MESSAGE",
        payload: id,
    };
}
