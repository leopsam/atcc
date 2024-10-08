'use client'
import { signOut } from 'next-auth/react'

export default function SignoutButtonUsers() {
    return (
        <button className="btn btn-secondary w-100 rounded-0 my-2 text-white" onClick={() => signOut()}>
            Sair
        </button>
    )
}
