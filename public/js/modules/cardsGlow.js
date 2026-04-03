export function initCardsGlow() {
    const cards = document.querySelectorAll(".card");
    if (cards.length === 0) return;

    // Sur mobile (pointer coarse), l'effet est souvent inutile
    const finePointer =
        window.matchMedia && window.matchMedia("(pointer: fine)").matches;

    if (!finePointer) return;

    cards.forEach((card) => {
        let rafId = 0;
        let nextX = 0;
        let nextY = 0;

        const apply = () => {
            rafId = 0;
            card.style.setProperty("--mx", `${nextX}%`);
            card.style.setProperty("--my", `${nextY}%`);
        };

        card.addEventListener("pointermove", (e) => {
            const rect = card.getBoundingClientRect();
            nextX = ((e.clientX - rect.left) / rect.width) * 100;
            nextY = ((e.clientY - rect.top) / rect.height) * 100;

            if (!rafId) rafId = window.requestAnimationFrame(apply);
        });

        card.addEventListener("pointerleave", () => {
            if (rafId) {
                window.cancelAnimationFrame(rafId);
                rafId = 0;
            }
            card.style.removeProperty("--mx");
            card.style.removeProperty("--my");
        });
    });
}
