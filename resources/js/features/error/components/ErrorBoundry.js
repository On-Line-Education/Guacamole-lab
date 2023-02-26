import React from 'react'
import { useSelector } from 'react-redux'
import ErrorMessage from './ErrorMessage'
import '../assets/errorBoundry.scss'

export default function ErrorBoundry(props) {
    const errors = useSelector(state => state.error.errors)

  return (
    <>
        {props.children}
        <div className='error-boundry'>
            {errors.map((error, i)=> {
                return <ErrorMessage error={error} key={i}/>
            })}
        </div>
    </>
  )
}
