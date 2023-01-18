import React from 'react'
import { GuacamoleButton, GuacamoleInput } from '../../../mui'

export default function LoginForm() {
  return (
    <div className='login-form'>
        <div className='welcome'>
            Witaj w Guacamole Lab
            <span>Zaloguj się podając informacje poniżej</span>
        </div>
        <div className='login-form-input'>
            <label className='login-form-label'>Nazwa użytkownika</label>
            <GuacamoleInput id="username" variant="outlined" size="small"/>
        </div>
        <div className='login-form-input' id='password'>
            <label className='login-form-label'>Hasło</label>
            <GuacamoleInput id="password" variant="outlined" type="password" size="small"/>
        </div>
        <div className='login-form-submit'>
            <GuacamoleButton variant='contained'>Zaloguj</GuacamoleButton>
        </div>
    </div>
  )
}
