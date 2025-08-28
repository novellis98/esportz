const btnDarkMode = document.querySelector("#darkmode");
const btnDarkMode2 = document.querySelector("#darkmode2");
const btnMoon1 = document.querySelector("#moon1");
const btnSun1 = document.querySelector("#sun1");
const btnMoon2 = document.querySelector("#moon2");
const btnSun2 = document.querySelector("#sun2");
const logo = document.querySelector("#logo");

document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.documentElement.classList.add("dark");
        btnMoon1.style.display = "none";
        btnSun1.style.display = "block";
        btnMoon2.style.display = "none";
        btnSun2.style.display = "block";
        logo.src = "/storage/images/logo-bianco.png";
    } else {
        btnMoon1.style.display = "block";
        btnSun1.style.display = "none";
        btnMoon2.style.display = "block";
        btnSun2.style.display = "none";
        logo.src = "/storage/images/logo-nero.png";
    }
});

btnDarkMode.addEventListener("click", toggleTheme);
btnDarkMode2.addEventListener("click", toggleTheme);

function toggleTheme() {
    document.documentElement.classList.toggle("dark");
    if (document.documentElement.classList.contains("dark")) {
        btnMoon1.style.display = "none";
        btnSun1.style.display = "block";
        btnMoon2.style.display = "none";
        btnSun2.style.display = "block";
        localStorage.setItem("theme", "dark");
        logo.src = "/storage/images/logo-bianco.png";
    } else {
        btnMoon1.style.display = "block";
        btnSun1.style.display = "none";
        btnMoon2.style.display = "block";
        btnSun2.style.display = "none";
        localStorage.removeItem("theme");
        logo.src = "/storage/images/logo-nero.png";
    }
}
