import Link from 'next/link'

export default function ButtonBack({ href }) {
    return (
        <Link href={href} className="btn text-bg-light border border-dark-subtle m-1">
            Voltar
        </Link>
    )
}
