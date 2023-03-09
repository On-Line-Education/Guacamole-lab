const initialState = {
    errors: [],
};

export function AlertsReducer(state = initialState, action) {
    switch (action.type) {
        case "FAILED_ACTION":
            return {
                ...state,
                errors: [...state.errors, action.payload],
            };
        case "DELETE_ERROR":
            return {
                errors: [
                    ...state.errors.filter(
                        (error) => error.code != action.payload
                    ),
                ],
            };
        case "CONNECTION_ERROR":
            return {
                ...state,
                errors: [...state.errors, action.payload],
            };
    }
    return state;
}
