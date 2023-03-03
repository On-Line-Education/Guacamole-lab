import { combineReducers, configureStore } from "@reduxjs/toolkit";
import { AuthReducer } from "./features/auth/state/authRedducers";
import {
    AlertsReducer,
    ErrorReducer,
} from "./features/alert/state/alertsReducer";

const rootReducer = combineReducers({
    alerts: AlertsReducer,
    auth: AuthReducer,
});

const store = configureStore({
    reducer: rootReducer,
});

export default store;
