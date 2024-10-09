import Link from 'next/link'

export default function ButtonBack() {
    return (
        <Link type="submit" href="/adm/user/read" className="btn text-bg-light border border-dark-subtle m-1">
            Voltar
        </Link>
    )
}
