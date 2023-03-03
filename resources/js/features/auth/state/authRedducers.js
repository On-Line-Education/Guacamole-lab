const initialState = {
    token: "",
};

export function AuthReducer(state = initialState, action) {
    switch (action.type) {
        case "LOGIN":
            return {
                ...state,
                token: action.payload,
            };
        case "LOGOUT":
            return {
                ...state,
                token: "",
            };
    }
    return state;
}
