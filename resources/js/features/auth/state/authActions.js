export function loginAction(data) {
    return {
        type: "LOGIN",
        payload: data,
    };
}

export function logoutAction() {
    return {
        type: "LOGOUT",
    };
}
