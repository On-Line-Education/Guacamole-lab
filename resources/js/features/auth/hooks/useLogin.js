import {useEffect, useState} from 'react'
import usePost from '../../../hooks/usePost'
import { useNavigate } from 'react-router-dom'

export default function useLogin(username, password) {
    const [data, loading, refresh, error] = usePost('/login', false, {username: username,password: password})
    const [token, setToken] = useState()
    const navigate = useNavigate();

    useEffect(()=>{

        if (!loading && !error) {
            try {
                setToken(data.token)

                console.log(data)

                localStorage.setItem('token', data.token)

                navigate('/home')
            } catch(e) {
                console.log(e)
            }
        }
     },[login, loading, data, error]);

    const login = async () => {
        refresh();
    }




    return [token, error, login]
}
