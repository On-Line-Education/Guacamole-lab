import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { GuacamoleButton, GuacamoleInput } from '../../../mui'
import login from '../api/login'

export default function LoginForm() {
    const [username, setUsername] = useState('')
    const [password, setPassword] = useState('')

    const navigate = useNavigate();

    async function handleSubmit(e) {
        e.preventDefault();
        
        await login(username, password)

        navigate("/home")

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
