const initialState = {
    messages: [],
};

export function AlertsReducer(state = initialState, action) {
    switch (action.type) {
        case "ACTION_FAILED":
            return {
                ...state,
                messages: [...state.messages, action.payload],
            };
        case "ACTION_SUCCEED":
            return {
                ...state,
                messages: [...state.messages, action.payload],
            };
        case "DELETE_MESSAGE":
            return {
                messages: [
                    ...state.messages.filter(
                        (message) => message.id != action.payload
                    ),
                ],
            };
    }
    return state;
}
