import Navbar from './navbar/page'
import { Suspense } from 'react'
import Loading from './loading'

export default function StudentLayout({ children }) {
    return (
        <main>
            <Navbar />
            <Suspense fallback={<Loading />}>{children}</Suspense>
        </main>
    )
}
