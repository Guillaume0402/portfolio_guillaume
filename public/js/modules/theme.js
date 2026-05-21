const STORAGE_KEY = "theme";

function getStoredTheme() {
    try {
        return localStorage.getItem(STORAGE_KEY) === "dark" ? "dark" : "light";
    } catch (error) {
        return "light";
    }
}

function saveTheme(theme) {
    try {
        localStorage.setItem(STORAGE_KEY, theme);
    } catch (error) {
        // Ignore storage failures; the current page still updates.
    }
}

function applyTheme(theme, toggle) {
    document.documentElement.dataset.theme = theme;
    document.documentElement.dataset.bsTheme = theme;

    if (!toggle) return;

    const isDark = theme === "dark";
    const label = isDark ? "Activer le mode clair" : "Activer le mode sombre";

    toggle.setAttribute("aria-label", label);
    toggle.setAttribute("aria-pressed", String(isDark));
    toggle.setAttribute("title", label);
}

export function initThemeToggle() {
    const toggle = document.querySelector("[data-theme-toggle]");
    const initialTheme = document.documentElement.dataset.theme === "dark" ? "dark" : getStoredTheme();

    applyTheme(initialTheme, toggle);

    if (!toggle) return;

    toggle.addEventListener("click", () => {
        const nextTheme = document.documentElement.dataset.theme === "dark" ? "light" : "dark";

        saveTheme(nextTheme);
        applyTheme(nextTheme, toggle);
    });
}
