const initialState = {
    'token': "",
    'id': "",
    'username': ""
}

export function AuthReducer(state = initialState, action) {
    switch (action.type) {
        case 'LOGIN':
            localStorage.setItem('token', action.payload.body.token)

            return {
                ...state,
                'token': action.payload.body.token,
                'id': action.payload.body.user.id,
                'username': action.payload.body.user.username
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