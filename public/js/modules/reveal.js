export function initReveal() {
    const revealEls = document.querySelectorAll(".reveal");
    if (revealEls.length === 0) return;

    const prefersReduced =
        window.matchMedia &&
        window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    if (prefersReduced || !("IntersectionObserver" in window)) {
        revealEls.forEach((el) => el.classList.add("is-visible"));
        return;
    }

    document.documentElement.classList.add("reveal-ready");

    const io = new IntersectionObserver(
        (entries) => {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    io.unobserve(entry.target);
                }
            }
        },
        { threshold: 0.12, rootMargin: "0px 0px -10% 0px" },
    );

    revealEls.forEach((el) => {
        io.observe(el);

        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            el.classList.add("is-visible");
            io.unobserve(el);
        }
    });
}
