import {useEffect, useState} from 'react'
import useGet from '../../../hooks/useGet'
import { useNavigate } from 'react-router-dom'


export default function useLogout() {
    const [data, loading, refresh, statusCode] = useGet('/logout', false)
    const [error, setError] = useState()
    const navigate = useNavigate();

    useEffect(()=>{

        if (!loading) {
            try {
                if(statusCode !== 200) {
                    setError({code: statusCode, messages: Object.values(data.errors)})
                }
                else {
                    localStorage.removeItem('token')

                    navigate('/')
                }
            } catch(e) {

            }
        }
     },[logout, loading, data, statusCode]);

    const logout = async () => {
        refresh();
    }




    return [error, logout]
}
