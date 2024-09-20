import Navbar from "./components/Navbar";
import ThemeRead from "./components/ThemeRead";
import UserRead from "./components/UserRead";
import UserCreat from "./components/UserCreat";
import ThemeCreat from "./components/ThemeCreat";

export default function Adm() {
  return (
    <main>
      <Navbar />
      <ThemeRead />
      <UserRead />
      <UserCreat />
      <ThemeCreat />
    </main>
  );
}
