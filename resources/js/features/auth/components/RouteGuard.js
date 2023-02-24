import React from 'react';
import { Outlet, Navigate } from 'react-router-dom';
import { useSelector } from 'react-redux';

const RouteGuard = () => {
    const token = useSelector(state => state.auth.token)
    console.log(token)
    return token ? <Outlet/> : <Navigate to='/' exact />
};

export default RouteGuard

