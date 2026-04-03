export function initMenu() {
    const btn = document.querySelector(".nav-toggle");
    const nav = document.querySelector("#site-nav");

    if (!btn || !nav) return;

    btn.addEventListener("click", () => {
        const isOpen = btn.getAttribute("aria-expanded") === "true";
        btn.setAttribute("aria-expanded", String(!isOpen));
        nav.classList.toggle("is-open", !isOpen);
    });

    // Ferme le menu quand tu cliques un lien (mobile)
    nav.addEventListener("click", (e) => {
        if (e.target && e.target.matches("a")) {
            btn.setAttribute("aria-expanded", "false");
            nav.classList.remove("is-open");
        }
    });
}
