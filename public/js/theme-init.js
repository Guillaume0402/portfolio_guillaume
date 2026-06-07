(() => {
    const getSystemTheme = () => window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";

    try {
        const storedTheme = localStorage.getItem("theme");
        const theme = storedTheme === "dark" || storedTheme === "light" ? storedTheme : getSystemTheme();

        document.documentElement.dataset.theme = theme;
        document.documentElement.dataset.bsTheme = theme;
    } catch (error) {
        const theme = getSystemTheme();

        document.documentElement.dataset.theme = theme;
        document.documentElement.dataset.bsTheme = theme;
    }
})();
