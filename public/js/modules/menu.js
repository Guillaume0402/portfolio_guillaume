export function initMenu() {
    const button = document.querySelector(".nav-toggle");
    const nav = document.querySelector("#site-nav");
    if (!button || !nav) return;

    button.closest(".site-header").classList.add("menu-ready");

    function setOpen(open) {
        button.setAttribute("aria-expanded", String(open));
        button.querySelector(".sr-only").textContent = open ? "Fermer le menu" : "Ouvrir le menu";
        nav.classList.toggle("is-open", open);
    }

    button.addEventListener("click", () => {
        setOpen(button.getAttribute("aria-expanded") !== "true");
    });

    nav.addEventListener("click", (event) => {
        const link = event.target.closest("a");
        if (!link || button.getAttribute("aria-expanded") !== "true") return;
        setOpen(false);

        if (link.pathname === location.pathname && link.hash) {
            const target = document.getElementById(link.hash.slice(1));
            if (!target) return;
            target.tabIndex = -1;
            // Déplacer le focus sans gêner le défilement natif vers l'ancre.
            target.focus({ preventScroll: true });
        }
    });

    button.closest(".site-header").addEventListener("keydown", (event) => {
        if (event.key !== "Escape" || button.getAttribute("aria-expanded") !== "true") return;
        setOpen(false);
        button.focus();
    });
}
