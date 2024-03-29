const initialState = {
    token: "",
    id: "",
    username: "",
    role: "",
};

export function AuthReducer(state = initialState, action) {
    switch (action.type) {
        case "LOGIN":
            return {
                ...state,
                token: action.payload.token,
                id: action.payload.user.id,
                username: action.payload.user.username,
                role: action.payload.user.role,
            };
        case "LOGOUT":
            return {
                ...state,
                token: "",
                id: "",
                username: "",
                role: "",
            };
        case "USER_UNAUTHENTICATED":
            return {
                ...state,
                token: "",
                id: "",
                username: "",
                role: "",
            };
    }
    return state;
}
