export default function ChangePassword() {
    return (
        <>
            <div className="accordion accordion-flush border border-secondary-subtle p-0 mx-auto mb-4 w-75" id="accordionFlushExample">
                <div className="accordion-item">
                    <h2 className="accordion-header">
                        <button
                            className="accordion-button collapsed text-bg-light"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne"
                        >
                            Alterar Senha
                        </button>
                    </h2>
                    <div id="flush-collapseOne" className="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div className="accordion-body text-grup">
                            <strong>ATENÇÃO</strong> Para garantir a segurança de sua conta, siga rigorosamente as etapas abaixo ao alterar sua senha:
                            <br />
                            1 - Informe a senha antiga: Para sua proteção, é necessário que você insira sua senha atual.
                            <br />
                            2 - Digite a nova senha: Escolha uma nova senha segura, que contenha uma combinação de letras, números e símbolos.
                            <br />
                            3 - Confirme a nova senha: Por favor, insira a nova senha novamente para garantir que não houve erro de digitação.
                            <br />
                            ⚠️ Importante: Se as senhas não coincidirem, o processo de alteração não será concluído. Certifique-se de que está digitando as
                            informações corretamente.
                            <div className="col-md-6 d-flex align-items-center my-3">
                                <label htmlFor="password-old" className="form-label m-0 p-0 w-75">
                                    Informe a senha atual:
                                </label>
                                <input
                                    type="password"
                                    className="form-control mx-2 form-control-sm w-100"
                                    id="password-old"
                                    name="password-old"
                                    placeholder="Senha"
                                />
                            </div>
                            <div className="col-md-6 d-flex align-items-center my-3">
                                <label htmlFor="password-new" className="form-label m-0 p-0 w-75">
                                    Digite a nova senha:
                                </label>
                                <input
                                    type="password"
                                    className="form-control mx-2 form-control-sm w-100"
                                    id="password-new"
                                    name="password-new"
                                    placeholder="Nova Senha"
                                />
                            </div>
                            <div className="col-md-6 d-flex align-items-center my-3">
                                <label htmlFor="confirm-password" className="form-label m-0 p-0 w-75">
                                    Confirme a nova senha:
                                </label>
                                <input
                                    type="password"
                                    className="form-control mx-2 form-control-sm w-100"
                                    id="confirm-password"
                                    name="confirm-password"
                                    placeholder="Confirme Nova Senha"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr />
        </>
    )
}
