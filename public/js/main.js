// Le navigateur ne transmet pas la version de main.js aux modules importés.
const versionQuery = new URL(import.meta.url).search;
const [
    { initMenu },
    { initThemeToggle },
    { initFooter },
    { initReveal },
    { initCardsGlow },
    { initToggleCard },
    { initStudio },
] = await Promise.all([
    import("./modules/menu.js" + versionQuery),
    import("./modules/theme.js" + versionQuery),
    import("./modules/footer.js" + versionQuery),
    import("./modules/reveal.js" + versionQuery),
    import("./modules/cardsGlow.js" + versionQuery),
    import("./modules/toggle-card.js" + versionQuery),
    import("./modules/studio.js" + versionQuery),
]);

function initUI() {
    initMenu();
    initThemeToggle();
    initFooter();
    initReveal();
    initCardsGlow();
    initToggleCard();
    initStudio();
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initUI, { once: true });
} else {
    initUI();
}
