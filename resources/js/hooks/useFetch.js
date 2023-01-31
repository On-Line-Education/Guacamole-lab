import {useState, useEffect} from 'react'

const useFetch = ({endpoint, method, data, start}) => {
    const [result,setResult] = useState(null);
    const [loading,setLoading] = useState(false);
    const [statusCode,setCode] = useState(null);

    useEffect(()=>{
        if(start) fetchData();
     },[fetchData, start]);

    const fetchData = async () => {
        if(loading) return;
        
        setLoading(true);
        const staticURL = `${'http://localhost:8080/api'}${endpoint}`
        const headers = {
            "Accept": "application/json",
            "Authorization": localStorage.getItem('token')? `Bearer ${localStorage.getItem('token')}`: {} 
        };

        const requestOptions = {
            headers: headers,
            method: method
        }

        if(data) {
            requestOptions.headers['Content-Type'] = "application/json" 
            requestOptions['body'] = JSON.stringify(data)
        }

        const response = await fetch(staticURL, requestOptions);

        setCode(response.status);
        try {
            const data = await response.json();
            setResult(data);
        } catch(err) {
            setResult({});
        }
        setLoading(false);
    }

    const refresh = () => {
        fetchData();
    }

    return ([result, loading, refresh, statusCode]);
}

export default useFetch
