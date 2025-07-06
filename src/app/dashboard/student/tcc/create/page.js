'use client'
import ButtonBack from '@/app/components/ButtonBack'
import ButtonSubmit from '@/app/components/ButtonSubmit'
import 'bootstrap-icons/font/bootstrap-icons.css'
import { createTccActions, checkByUserIdInMembers } from '@/app/actions/tcc/createTccActions'
import { useState, useEffect } from 'react'
import { toast } from 'react-toastify'
import Loading from '../../loading'
import { useRouter } from 'next/navigation'
import Link from 'next/link'

export default function Page() {
    const [tccExists, setTccExists] = useState(false)
    const [themes, setThemes] = useState([])
    const [teachers, setTeachers] = useState([])
    const [students, setStudents] = useState([])
    const [componentes, setComponentes] = useState([''])
    const router = useRouter()

    useEffect(() => {
        async function tccAlreadyExists() {
            const res = await checkByUserIdInMembers()
            setTccExists(res.success)
        }

        async function fetchThemes() {
            const res = await fetch('/api/themes')
            const json = await res.json()
            setThemes(json.data)
        }

        async function fetchTeacher() {
            const res = await fetch('/api/teacher')
            const json = await res.json()
            setTeachers(json.data)
        }
        async function fetchStudents() {
            const res = await fetch('/api/student')
            const json = await res.json()
            setStudents(json.data)
        }

        tccAlreadyExists()
        fetchThemes()
        fetchTeacher()
        fetchStudents()
    }, [tccExists])

    const handleSubmit = async formData => {
        const formDataObj = Object.fromEntries(formData.entries())

        const data = {
            ...formDataObj,
            members: componentes,
        }
        const response = await createTccActions(data)

        if (!response.success) {
            toast.error('Todos os campos devem ser informados!', {
                position: 'bottom-center',
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: false,
                pauseOnHover: false,
                draggable: false,
                progress: undefined,
                theme: 'light',
            })
        } else {
            toast.success('TCC criado com sucesso!', {
                position: 'bottom-center',
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: false,
                pauseOnHover: false,
                draggable: false,
                progress: undefined,
                theme: 'light',
            })

            setTimeout(() => {
                router.push('/student/tcc/read')
            }, 2000)
        }
    }

    const adicionarComponente = () => {
        setComponentes([...componentes, ''])
    }

    const removerComponente = index => {
        setComponentes(componentes.filter((_, i) => i !== index))
    }

    const handleChange = (index, value) => {
        const novos = [...componentes]
        novos[index] = value
        setComponentes(novos)
    }

    if (tccExists === true) {
        return (
            <section className="dashboard">
                <div className="text-black bg-primary-subtle pt-5 pb-4 px-3">
                    <h1 className="fs-2">Você já possui um TCC cadastrado.</h1>
                    <p className="fs-6">
                        Acesse no menu superior &quot;Proposta&quot;, ou clique no botão abaixo para ser redirecionado.
                        <br />
                        <Link className="btn btn-primary my-2" href="/dashboard/student/tcc/read">
                            Acesse a pagina de Proposta
                        </Link>
                    </p>
                </div>
            </section>
        )
    }

    if (students.length === 0 || themes.length === 0 || teachers.length === 0) {
        return <Loading />
    }

    return (
        <section className="dashboard">
            <div className="text-black bg-primary-subtle pt-5 pb-4 px-3">
                <h1 className="fs-2">Insira as informações do seu TCC</h1>
                <p className="fs-6">
                    O cadastro de proposta serve para registrar as informações principais do seu TCC. Nele, você deve informar:
                    <br />
                    <strong>Orientador:</strong> O professor que irá acompanhar e orientar o seu trabalho.
                    <br />
                    <strong>Tema:</strong> O assunto ou área principal que o seu TCC irá defender ou desenvolver.
                    <br />
                    <strong>Componentes:</strong>Os componentes (integrantes) do grupo que participarão do projeto, caso o TCC seja individual, basta cadastrar
                    apenas o seu nome.
                    <br />
                </p>
            </div>

            <div className="px-4 py-2">
                <form className="row g-2 text-black w-50 my-2" action={handleSubmit}>
                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="advisor" className="form-label m-0 p-0 fs-6">
                            Orientador:
                        </label>
                        <select id="advisor" name="advisor" className="form-select mx-2 form-select-sm">
                            <option value="" defaultValue>
                                Selecione
                            </option>
                            {teachers.map(teacher => (
                                <option key={teacher.id} value={teacher.id}>
                                    {teacher.name}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="col-12 d-flex align-items-center my-3">
                        <label htmlFor="situacao" className="form-label m-0 p-0 fs-6">
                            Tema:
                        </label>
                        <select id="themeId" name="themeId" className="form-select mx-2 form-select-sm">
                            <option value="" defaultValue>
                                Selecione
                            </option>
                            {themes.map(theme => (
                                <option key={theme.id} value={theme.id}>
                                    {theme.name}
                                </option>
                            ))}
                        </select>
                    </div>

                    <table className="table my-3">
                        <thead>
                            <tr>
                                <th scope="col">Nome dos componentes:</th>
                                <th scope="col">
                                    <i className="bi bi-plus-circle-fill custom-icon-green" style={{ cursor: 'pointer' }} onClick={adicionarComponente}></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {componentes.map((componente, index) => (
                                <tr key={index}>
                                    <td>
                                        <select
                                            id="student"
                                            name="student"
                                            className="form-select mx-2 form-select-sm"
                                            onChange={e => handleChange(index, e.target.value)}
                                        >
                                            <option value="" defaultValue>
                                                Selecione
                                            </option>
                                            {students.map(student => (
                                                <option key={student.id} value={student.id}>
                                                    {student.name}
                                                </option>
                                            ))}
                                        </select>
                                    </td>
                                    <td>
                                        <i
                                            className="bi bi-x-circle-fill custom-icon-red"
                                            style={{ cursor: 'pointer' }}
                                            onClick={() => removerComponente(index)}
                                        ></i>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    <div className="col-12 d-flex align-items-center py-2">
                        <ButtonSubmit>Enviar</ButtonSubmit>
                        <ButtonBack href={'/adm/tcc/read'} />
                    </div>
                </form>
            </div>
        </section>
    )
}
