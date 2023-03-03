const initialState = {
    messages: [],
};

export function MessageReducer(state = initialState, action) {
    switch (action.type) {
        case "CREATE_MESSAGE":
            return {
                ...state,
                messages: [...state.messages, action.payload],
            };
        case "DELETE_MESSAGE":
            return {
                messages: [
                    ...state.errors.filter(
                        (message) => message.type != action.payload
                    ),
                ],
            };
    }
    return state;
}
