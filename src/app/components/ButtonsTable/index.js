import Link from 'next/link'

export default function ButtonsTable({ children, href }) {
    return (
        <Link href={href} className="btn btn-secondary btn-sm m-1 text-white">
            {children}
        </Link>
    )
}
