import {useEffect, useState} from 'react'
import usePost from '../../../hooks/usePost'
import { useNavigate } from 'react-router-dom'


export default function useLogin(username, password) {
    const [data, loading, refresh, statusCode] = usePost('/login', false, {username: username,password: password})
    const [error, setError] = useState()
    const [token, setToken] = useState()
    const navigate = useNavigate();

    useEffect(()=>{

        if (!loading) {
            try {
                if(statusCode !== 200) {
                    setError({code: statusCode, messages: Object.values(data.errors)})
                }
                else {
                    setToken(data.token)

                    console.log(data)

                    localStorage.setItem('token', data.token)

                    navigate('/home')
                }
            } catch(e) {

            }
        }
     },[login, loading, data, statusCode]);

    const login = async () => {
        refresh();
    }




    return [token, error, login]
}
