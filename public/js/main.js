import { initMenu } from "./modules/menu.js";
import { initReveal } from "./modules/reveal.js";
import { initCardsGlow } from "./modules/cardsGlow.js";
import { initToggleCard } from "./modules/toggle-card.js";
import { initThemeToggle } from "./modules/theme.js";

function initUI() {
    initMenu();
    initThemeToggle();
    initReveal();
    initCardsGlow();
    initToggleCard();
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initUI, { once: true });
} else {
    initUI();
}
