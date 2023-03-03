export function createMessage(message) {
    return {
        type: "CREATE_MESSAGE",
        payload: message,
    };
}

export function deleteMessage(type) {
    return {
        type: "DELETE_MESSAGE",
        payload: type,
    };
}
