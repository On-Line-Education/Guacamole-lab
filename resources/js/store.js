import { configureStore } from '@reduxjs/toolkit'
import { combineReducers } from '@reduxjs/toolkit'
import { ErrorReducer } from './features/error/state/errorReducers'
import { AuthReducer } from './features/auth/state/authReducers'

const rootReducer = combineReducers({error: ErrorReducer, auth: AuthReducer})

export default configureStore({
  reducer: rootReducer,
})