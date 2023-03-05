export function loginFailedAction(error) {
    return {
        type: "LOGIN_FAILED_ACTION",
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

export function userCreationFailedAction(error) {
    return {
        type: "USER_CREATION_FAILED",
        payload: error,
    };
}

export function groupCreationFailedAction(error) {
    return {
        type: "GROUP_CREATION_FAILED",
        payload: error,
    };
}

export function classroomCreationFailedAction(error) {
    return {
        type: "GROUP_CREATION_FAILED",
        payload: error,
    };
}
