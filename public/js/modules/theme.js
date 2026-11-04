const STORAGE_KEY = "theme";

function getStoredTheme() {
    try {
        const theme = localStorage.getItem(STORAGE_KEY);

        return theme === "dark" || theme === "light" ? theme : null;
    } catch {
        return undefined;
    }
}

function saveTheme(theme) {
    try {
        localStorage.setItem(STORAGE_KEY, theme);
    } catch {
        // Ignore storage failures; the current page still updates.
    }
}

function applyTheme(theme, toggle) {
    document.documentElement.dataset.theme = theme;
    document.documentElement.dataset.bsTheme = theme;

    if (!toggle) return;

    toggle.setAttribute("aria-pressed", String(theme === "dark"));
}

export function initThemeToggle() {
    const toggle = document.querySelector("[data-theme-toggle]");
    const systemPreference = window.matchMedia?.("(prefers-color-scheme: dark)");
    let manualTheme = getStoredTheme();

    const updateTheme = () => {
        applyTheme(manualTheme ?? (systemPreference?.matches ? "dark" : "light"), toggle);
    };
    const syncTheme = () => {
        const storedTheme = getStoredTheme();

        // Un stockage indisponible ne doit pas effacer le choix en mémoire.
        if (storedTheme !== undefined) manualTheme = storedTheme;
        updateTheme();
    };

    updateTheme();

    systemPreference?.addEventListener?.("change", () => {
        if (!manualTheme) updateTheme();
    });
    window.addEventListener("pageshow", (event) => {
        // Le retour arrière peut restaurer une page avec son ancien thème.
        if (event.persisted) syncTheme();
    });
    window.addEventListener("storage", (event) => {
        if (event.key === STORAGE_KEY || event.key === null) syncTheme();
    });
    toggle?.addEventListener("click", () => {
        manualTheme = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
        saveTheme(manualTheme);
        updateTheme();
    });
}
