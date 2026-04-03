export function initToggleCard() {
    document.querySelectorAll(".card-description").forEach((block) => {
        const text = block.querySelector(".card-text");
        const button = block.querySelector(".card-text-toggle");

        if (!text || !button) return;

        const checkOverflow = () => {
            text.classList.remove("is-expanded");
            button.textContent = "Lire plus";

            if (text.scrollHeight <= text.clientHeight + 2) {
                button.classList.add("is-hidden");
            } else {
                button.classList.remove("is-hidden");
            }
        };

        button.addEventListener("click", () => {
            const expanded = text.classList.toggle("is-expanded");
            button.textContent = expanded ? "Lire moins" : "Lire plus";
        });

        checkOverflow();
        window.addEventListener("resize", checkOverflow);
    });
}