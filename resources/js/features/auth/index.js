import React from 'react'
import Sidebar from './components/Sidebar'
import LoginForm from './components/LoginForm'
import { useState } from 'react'
import useLogin from './hooks/useLogin'

export default function LoginView() {
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [token, error, login] = useLogin(username, password)

  return (
    <div className='login'>
      <Sidebar />
      <div className='login-container'> 
          <LoginForm setUsername={setUsername} setPassword={setPassword} login={login}/>
      </div>
    </div>
  )
}
