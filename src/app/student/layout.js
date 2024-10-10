import { Suspense } from 'react'
import Loading from './loading'
import Navbar from './navbar/page'

export default function StudentLayout({ children }) {
    return (
        <main>
            <Navbar />
            <Suspense fallback={<Loading />}>{children}</Suspense>
        </main>
    )
}
