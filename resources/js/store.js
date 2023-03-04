import { combineReducers, configureStore } from "@reduxjs/toolkit";
import { AuthReducer } from "./features/auth/state/authReducer";
import { AlertsReducer } from "./features/alert/state/alertsReducer";
import { saveState, loadState } from "./features/localStorage/localStorage";
import { throttle } from "lodash";

const rootReducer = combineReducers({
    alerts: AlertsReducer,
    auth: AuthReducer,
});

const store = configureStore({
    reducer: rootReducer,
    preloadedState: loadState(),
});

store.subscribe(
    throttle(() => {
        saveState({ auth: store.getState().auth });
    }, 1000)
);

export default store;
