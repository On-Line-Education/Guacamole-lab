import {useEffect, useRef} from 'react'
import useGet from '../../../hooks/useGet'
import { useNavigate } from 'react-router-dom'
import { useDispatch } from 'react-redux'
import { logoutAction } from '../state/authActions';


export default function useLogout() {
    const [data, loading, refresh, error] = useGet('/logout', false);
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const didMount = useRef(false);

    useEffect(()=>{
        if(didMount.current) {
            if (!loading && error.length < 1) {
                try {
                    console.log()
    
                    dispatch(logoutAction())
    
                    navigate('/')
                } catch(e) {
    
                }
            }
        }
        else didMount.current = true
     },[logout, loading, data, error]);

    const logout = async () => {
        refresh();
    }

    return [error, logout]
}
