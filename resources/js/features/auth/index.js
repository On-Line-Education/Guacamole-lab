import React from 'react'
import Sidebar from './components/Sidebar'
import LoginForm from './components/LoginForm'

export default function LoginView() {
  return (
    <div className='login'>
      <Sidebar />
      <div className='login-container'> 
          <LoginForm/>
      </div>
    </div>
  )
}
