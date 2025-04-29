'use client';

import { useState } from 'react';

export default function ComponentsList() {
    const [componentes, setComponentes] = useState(['']);

    const adicionarComponente = () => {
        setComponentes([...componentes, '']);
    };

    const removerComponente = (index) => {
        setComponentes(componentes.filter((_, i) => i !== index));
    };

    const handleChange = (index, value) => {
        const novos = [...componentes];
        novos[index] = value;
        setComponentes(novos);
    };

    return (
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
                            <input
                                type="text"
                                className="form-control mx-2 form-control-sm w-75"
                                value={componente}
                                onChange={(e) => handleChange(index, e.target.value)}
                            />
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
    );
}
