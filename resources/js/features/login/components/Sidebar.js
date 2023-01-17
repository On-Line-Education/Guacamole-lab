import React from 'react'
import Avocado from "../assets/avocado.svg"
import "../assets/style.scss"

export default function Sidebar() {
  return (
    <div className='login-sidebar'>
        <div className='logo'>
            <img src={Avocado} width="25px"/>
            <span>Guacamole Lab</span>
        </div>
        <div className='description'>
            OPIS
        </div>
    </div>
  )
}
