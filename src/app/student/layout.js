import Navbar from './navbar/page';

export default function StudentLayout({ children }) {
    return (
        <main>
            <Navbar />
            {children}
        </main>
    );
}
