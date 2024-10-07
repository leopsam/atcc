import Navbar from './navbar/page';

export default function AdmLayout({ children }) {
    return (
        <main>
            <Navbar />
            {children}
        </main>
    );
}
