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
        const headers = data === undefined ? {} : {
            "Content-Type":"application/json",
            "Accept": "application/json"
        };
        const response = await fetch(staticURL, {
            headers,
            body:JSON.stringify(data === undefined ? {} : data),
            method,
        });
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
