'use client';
import { toast } from 'react-toastify';
import { signIn } from 'next-auth/react';

export default function LoginForm() {
    async function login(e) {
        e.preventDefault();
        const formData = new FormData(e.currentTarget);

        const data = {
            username: formData.get('username'),
            password: formData.get('password'),
        };

        const res = await signIn('credentials', {
            ...data,
            redirect: false,
        });

        if (res?.error) {
            toast.error(res.error, {
                position: 'bottom-center',
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
        }

        if (res.ok) {
            const session = await fetch('/api/auth/session').then((res) => res.json());

            if (session?.user?.role === 'STUDENT') {
                window.location.href = '/student';
            } else if (session?.user?.role === 'TEACHER') {
                window.location.href = '/teacher';
            } else if (session?.user?.role === 'ADMIN') {
                window.location.href = '/adm';
            } else {
                toast.error('Usuário desconhecido', {
                    position: 'bottom-center',
                    autoClose: 3000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
            }
        }
    }

    return (
        <form className="d-flex" role="Login" onSubmit={login}>
            <input className="form-control form-control-sm me-2" type="text" placeholder="username" aria-label="username" name="username" required />
            <input className="form-control form-control-sm me-2" type="password" placeholder="Senha" aria-label="Senha" name="password" required />
            <button className="btn btn-light" type="submit">
                Entrar
            </button>
        </form>
    );
}
