import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { GuacamoleButton, GuacamoleInput } from '../../../mui'
import useLogin from '../hooks/useLogin'

export default function LoginForm() {
    const [username, setUsername] = useState('')
    const [password, setPassword] = useState('')
    const [token, error, login] = useLogin(username, password)

    if(error) {
        console.log(error)
    }

    if(token) {
        console.log(token)
    }

    const navigate = useNavigate();

    function handleSubmit(e) {
        e.preventDefault();
        login()
    }

  return (
    <form className='login-form' onSubmit={(e) => {handleSubmit(e)}}>
        <div className='welcome'>
            Witaj w Guacamole Lab
            <span>Zaloguj się podając informacje poniżej</span>
        </div>
        <div className='login-form-input'>
            <label className='login-form-label'>Nazwa użytkownika</label>
            <GuacamoleInput id="username" variant="outlined" size="small" onChange={(e) => {setUsername(e.target.value)}}/>
        </div>
        <div className='login-form-input' id='password'>
            <label className='login-form-label'>Hasło</label>
            <GuacamoleInput id="password" variant="outlined" type="password" size="small" onChange={(e) => {setPassword(e.target.value)}}/>
        </div>
        <div className='login-form-submit'>
            <GuacamoleButton variant='contained' type='submit'>Zaloguj</GuacamoleButton>
        </div>
    </form>
  )
}
