const MAIN_URL = 'http://localhost:8080/api';

/**
 * @param {string} endpoint 
 * @param {RequestInit} requestOptions
 **/

export async function api(endpoint, requestOptions) {
    const requestUrl = `${MAIN_URL}${endpoint}`;

    if(!requestOptions.headers) {
        requestOptions.headers = {}
    }
    if(requestOptions.body) {
        requestOptions.headers["Accept"] = "application/json"
        requestOptions.headers["Content-Type"] = "application/json"
    }
    if(localStorage.getItem("token")) {
        requestOptions.headers["Authorization"] = localStorage.getItem("token");
    }

    //Authorization logic

    const response = await fetch(requestUrl, requestOptions)
    const result =  await response.json()
        if(response.ok) {
            return result
        }
        else {
            return {
                "code": response.status,
                "message": result.message
            }
        }

}

export default async function login(username, password) {
    const endpoint = "/login"
    const body = JSON.stringify({
        "username": username,
        "password": password
    });

    const result = await api(endpoint, {body: body, method:'POST'});

    if(result.token) {
        localStorage.setItem("token", result.token)
        console.log("token set")
        navigate('/home')
    }
    console.log(result)
}