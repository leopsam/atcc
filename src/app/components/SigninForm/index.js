'use client'
import { signIn } from 'next-auth/react'
import { useState } from 'react'
import { toast } from 'react-toastify'
import ButtonSubmit from '../ButtonSubmit'

export default function LoginForm() {
    const [spinner, setSpinner] = useState(false)

    async function login(e) {
        setSpinner(true)
        e.preventDefault()
        const formData = new FormData(e.currentTarget)

        const data = {
            username: formData.get('username'),
            password: formData.get('password'),
        }

        const res = await signIn('credentials', {
            ...data,
            redirect: false,
        })

        if (res?.error) {
            setSpinner(false)
            toast.error(res.error, {
                position: 'bottom-center',
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            })
        }

        if (res.ok) {
            const session = await fetch('/api/auth/session').then(res => res.json())

            if (session?.user?.role === 'STUDENT') {
                setSpinner(false)
                window.location.href = '/student'
            } else if (session?.user?.role === 'TEACHER') {
                setSpinner(false)
                window.location.href = '/teacher'
            } else if (session?.user?.role === 'ADMIN') {
                setSpinner(false)
                window.location.href = '/adm'
            } else {
                setSpinner(false)
                toast.error('Usuário desconhecido', {
                    position: 'bottom-center',
                    autoClose: 3000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                })
            }
        }
    }

    return (
        <form className="d-flex" role="Login" onSubmit={login}>
            <input className="form-control form-control-sm me-2" type="text" placeholder="username" aria-label="username" name="username" required />
            <input className="form-control form-control-sm me-2" type="password" placeholder="Senha" aria-label="Senha" name="password" required />

            <ButtonSubmit>{spinner === false ? 'Entre' : <span className="spinner-border spinner-border-sm" aria-hidden="true"></span>}</ButtonSubmit>
        </form>
    )
}
