import { configureStore } from '@reduxjs/toolkit'
import { ErrorReducer } from './features/error/state/errorReducers'

export default configureStore({
  reducer: ErrorReducer,
})