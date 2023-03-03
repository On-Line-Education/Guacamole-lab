export function loginFailedAction(error) {
    return {
        type: 'LOGIN_FAILED_ACTION',
        payload: error
    }
}

export function deleteError(code) {
    return {
        type: 'DELETE_ERROR',
        payload: code
    }
}