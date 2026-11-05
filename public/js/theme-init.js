(() => {
    // Appliquer le thème avant le CSS évite un premier affichage dans l'autre thème.
    let preference;

    try {
        preference = localStorage.getItem("theme");
    } catch {
        // La préférence système reste disponible sans stockage.
    }

    const theme = preference === "light" || preference === "dark"
        ? preference
        : (window.matchMedia?.("(prefers-color-scheme: dark)").matches ? "dark" : "light");

    document.documentElement.dataset.theme = theme;
    document.documentElement.dataset.bsTheme = theme;
})();
