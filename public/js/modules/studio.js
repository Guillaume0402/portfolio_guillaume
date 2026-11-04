function initEntrance(home) {
    const hero = home.querySelector("[data-studio-hero]");
    const replay = hero?.querySelector(".replay");
    const motion = window.matchMedia?.("(prefers-reduced-motion: no-preference)");
    if (!motion) return;

    if (motion.matches) hero?.classList.add("is-entering");

    if (replay) {
        replay.hidden = !motion.matches;
        replay.addEventListener("click", () => {
            hero.classList.remove("is-entering");
            // Laisser le navigateur afficher le retrait de la classe avant de la remettre.
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    if (motion.matches) hero.classList.add("is-entering");
                });
            });
        });
    }

    motion.addEventListener?.("change", () => {
        if (replay) replay.hidden = !motion.matches;
        if (!motion.matches) hero?.classList.remove("is-entering");
    });

    if (!("IntersectionObserver" in window)) return;

    const arrival = new IntersectionObserver((entries, observer) => {
        for (const entry of entries) {
            if (!entry.isIntersecting) continue;
            if (motion.matches) entry.target.classList.add("is-arriving");
            observer.unobserve(entry.target);
        }
    }, { threshold: 0.16 });

    home.querySelectorAll("[data-enter]").forEach((element) => arrival.observe(element));
}

function initAnnotations(home) {
    const picture = home.querySelector(".project-view");
    if (!picture) return;

    const buttons = [...home.querySelectorAll(".annotations [data-zone]")];
    let selected = "";
    let hovered = "";
    let focused = "";

    function showAnnotation() {
        // Le survol et le focus prévisualisent un repère sans effacer la sélection.
        picture.dataset.highlight = hovered || focused || selected;
    }

    for (const button of buttons) {
        button.addEventListener("pointerenter", (event) => {
            if (event.pointerType === "touch") return;
            hovered = button.dataset.zone;
            showAnnotation();
        });
        button.addEventListener("pointerleave", () => {
            hovered = "";
            showAnnotation();
        });
        button.addEventListener("focus", () => {
            if (!button.matches(":focus-visible")) return;
            focused = button.dataset.zone;
            showAnnotation();
        });
        button.addEventListener("blur", () => {
            focused = "";
            showAnnotation();
        });
        button.addEventListener("click", () => {
            selected = selected === button.dataset.zone ? "" : button.dataset.zone;
            for (const annotation of buttons) {
                annotation.setAttribute("aria-pressed", String(annotation.dataset.zone === selected));
            }
            showAnnotation();
        });
    }
}

function initSectionNavigation(home) {
    const hero = home.querySelector("[data-studio-hero]");
    const sections = [...home.querySelectorAll("[data-studio-hero], section[id]")];
    const links = new Map();
    for (const link of document.querySelectorAll(".studio-header #site-nav a")) {
        if (link.origin !== location.origin || link.pathname !== location.pathname) continue;
        const target = link.hash ? document.getElementById(link.hash.slice(1)) : hero;
        if (sections.includes(target)) links.set(target, link);
    }
    if (links.size === 0) return;

    let current;
    function setActive(section) {
        const next = links.get(section);
        if (next === current) return;
        current?.removeAttribute("aria-current");
        next?.setAttribute("aria-current", "location");
        current = next;
    }

    function activateHash() {
        const target = document.getElementById(location.hash.slice(1));
        setActive(sections.includes(target) ? target : hero);
    }

    activateHash();
    window.addEventListener("hashchange", activateHash);
    if (!("IntersectionObserver" in window)) return;

    let observer;
    let observedHeight;
    function observeSections() {
        const height = document.documentElement.clientHeight;
        if (height < 1 || height === observedHeight) return;
        observedHeight = height;
        observer?.disconnect();

        // Une ligne de lecture à 22 % de la hauteur. Les pourcentages de rootMargin
        // seraient calculés sur la largeur, même pour les marges verticales.
        const top = Math.floor(height * 0.22);
        const bottom = height - top - 1;
        observer = new IntersectionObserver((entries) => {
            const active = entries.find((entry) => entry.isIntersecting);
            if (active) setActive(active.target);
        }, { rootMargin: `${-top}px 0px ${-bottom}px 0px` });

        for (const section of sections) observer.observe(section);
    }

    observeSections();
    window.addEventListener("resize", observeSections);
}

export function initStudio() {
    const home = document.querySelector(".creative-home");
    if (!home) return;
    initEntrance(home);
    initAnnotations(home);
    initSectionNavigation(home);
}
