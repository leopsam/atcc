'use client';
import { signOut } from 'next-auth/react';

export default function SignoutButtonAdm() {
    return (
        <button type="button" className="btn p-0 custom-text" onClick={() => signOut()}>
            Sair
        </button>
    );
}
