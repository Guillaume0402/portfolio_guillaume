import { initMenu } from "./modules/menu.js";
import { initReveal } from "./modules/reveal.js";
import { initCardsGlow } from "./modules/cardsGlow.js";

function initUI() {
    initMenu();
    initReveal();
    initCardsGlow();
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initUI, { once: true });
} else {
    initUI();
}
