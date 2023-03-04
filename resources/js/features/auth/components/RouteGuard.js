import React from "react";
import { Outlet, Navigate } from "react-router-dom";
import { useSelector } from "react-redux";

const RouteGuard = ({ accessList }) => {
    const { token, role } = useSelector((state) => state.auth);

    if (token && accessList.includes(role)) {
        return <Outlet />;
    } else {
        return <Navigate to="/" exact />;
    }
};

export default RouteGuard;
