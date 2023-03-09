export function connectionError() {
    return {
        type: "CONNECTION_ERROR",
        payload: {
            type: "connection",
            code: "CONNECTION_ERROR",
            title: "Błąd połączenia",
            message: "Spróbuj ponownie później",
        },
    };
}

export function failedAction(error) {
    return {
        type: "FAILED_ACTION",
        payload: error,
    };
}

export function userUnauthenticated() {
    return {
        type: "USER_UNAUTHENTICATED",
    };
}

export function deleteError(code) {
    return {
        type: "DELETE_ERROR",
        payload: code,
    };
}
