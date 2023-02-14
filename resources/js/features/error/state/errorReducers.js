const initialState = {
    'errors': []
}

export function ErrorReducer(state = initialState, action) {
    switch (action.type) {
        case 'LOGIN_FAILED_ACTION':
            return {
                ...state,
                'errors': [...state.errors, action.payload]
            } 
        case 'DELETE_ERROR':
            return{
                'errors': [...state.errors.filter(error => error.code != action.payload)]
            }
    }
    return state
}