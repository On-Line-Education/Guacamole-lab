const initialState = {
    'token': "",
    'id': "",
    'username': ""
}

export function AuthReducer(state = initialState, action) {
    switch (action.type) {
        case 'LOGIN':
            localStorage.setItem('token', action.payload.token)

            return {
                ...state,
                'token': action.payload.token,
                'id': action.payload.user.id,
                'username': action.payload.user.username
            } 
        case 'LOGOUT':
            localStorage.removeItem('token')

            return{
                ...state,
                'token': "",
                'id': "",
                'username': ""
            }
    }
    return state
}