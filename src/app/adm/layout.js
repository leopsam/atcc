import { Suspense } from 'react'
import Loading from './loading'
import Navbar from './navbar/page'

export default function AdmLayout({ children }) {
    return (
        <main>
            <Navbar />
            <Suspense fallback={<Loading />}>{children}</Suspense>
        </main>
    )
}
