export default function ButtonSubmit({ children }) {
    return (
        <button className="btn btn-light width-btn border border-dark-subtle" type="submit">
            {children}
        </button>
    )
}
