   <main>
       <section class="container-app hero-section">
           <div class="container hero-inner">
               <div class="hero-media reveal">
                   <div class="container hero-copy">
                       <p class="hero-kicker">Guillaume Maignaut · Développeur Web</p>
                       <h1 class="hero-title">Je conçois des sites web modernes, rapides et maintenables.</h1>
                       <p class="hero-subtitle">
                           Intégration soignée, accessibilité, performance et SEO. Je transforme des idées en expériences web
                           claires et efficaces.
                       </p>

                       <div class="hero-actions">
                           <a class="btn btn-primary" href="#projects">Voir mes projets</a>
                           <a class="btn btn-ghost" href="/pages/contact.php">Me contacter</a>
                       </div>

                       <div class="hero-badges" aria-label="Points forts">
                           <span class="badge">Responsive</span>
                           <span class="badge">Performance</span>
                           <span class="badge">UX &amp; UI</span>
                       </div>
                   </div>

                   <div class="hero-terminal" aria-hidden="true">
                       <div class="terminal-bar">
                           <span class="terminal-dot dot-r"></span>
                           <span class="terminal-dot dot-y"></span>
                           <span class="terminal-dot dot-g"></span>
                           <span class="terminal-title">developer.php</span>
                       </div>
                       <div class="terminal-body">
                           <p class="tl"><span class="t-dim">01</span> <span class="t-kw">class</span> <span class="t-cls">Developer</span> {</p>
                           <p class="tl"><span class="t-dim">02</span> <span class="t-kw">public</span> <span class="t-var">$name</span> = <span class="t-str">'Guillaume'</span>;</p>
                           <p class="tl"><span class="t-dim">03</span> <span class="t-kw">public</span> <span class="t-var">$skills</span> = [</p>
                           <p class="tl"><span class="t-dim">04</span> <span class="t-str">'HTML'</span>, <span class="t-str">'CSS'</span>, <span class="t-str">'JS'</span>,</p>
                           <p class="tl"><span class="t-dim">05</span> <span class="t-str">'PHP'</span>, <span class="t-str">'Git'</span>, <span class="t-str">'Docker'</span></p>
                           <p class="tl"><span class="t-dim">06</span> ];</p>
                           <p class="tl t-blank"></p>
                           <p class="tl"><span class="t-dim">07</span> <span class="t-kw">public function</span> <span class="t-fn">build</span>(<span class="t-var">$idea</span>) {</p>
                           <p class="tl"><span class="t-dim">08</span> <span class="t-kw">return</span> <span class="t-str">"quelque chose de beau"</span>;</p>
                           <p class="tl"><span class="t-dim">09</span> }</p>
                           <p class="tl"><span class="t-dim">10</span> }</p>
                           <p class="tl t-blank"></p>
                           <p class="tl"><span class="t-dim">11</span> <span class="t-comment">// $ php -r "(new Developer)->build($idea);"</span></p>
                           <p class="tl"><span class="t-dim">12</span> <span class="t-ok">✓ Prêt à construire votre projet</span></p>
                           <p class="tl"><span class="t-dim">13</span> <span class="t-cur">▌</span></p>
                       </div>
                   </div>
               </div>
           </div>
           <!-- <div class="hero-scroll-hint" aria-hidden="true">
               <span class="scroll-line"></span>
           </div> -->
       </section>

       <section id="projects" class="section">
           <div class="container">
               <header class="section-header reveal">                   
                   <h2>Projets</h2>
                   <p>Une sélection de réalisations issues de la base de données.</p>
               </header>

               <?php if (empty($projects)): ?>
                   <p>Aucun projet pour le moment.</p>
               <?php else: ?>
                   <div class="cards-grid">
                       <?php foreach ($projects as $project): ?>
                           <?php $img = $project['image'] ?? 'default.png'; ?>

                           <article class="card reveal">
                               <div class="card-body">
                                   <div class="card-top">
                                       <h3 class="card-title">
                                           <?= htmlspecialchars($project['title']) ?>
                                       </h3>

                                       <div class="card-media">
                                           <img
                                               loading="lazy"
                                               src="/images/<?= htmlspecialchars($img) ?>"
                                               alt="Aperçu du projet <?= htmlspecialchars($project['title']) ?>">
                                       </div>

                                       <?php if (!empty($project['description'])): ?>
                                           <p class="card-text">
                                               <?= htmlspecialchars($project['description']) ?>
                                           </p>
                                       <?php endif; ?>
                                   </div>
                               </div>

                               <div class="tag-row" aria-label="Technologies">
                                   <span class="tag">HTML</span>
                                   <span class="tag">CSS</span>
                                   <span class="tag">PHP</span>
                               </div>

                               <div class="btn-projects">
                                   <?php if (!empty($project['github_link'])): ?>
                                       <div class="card-actions">
                                           <a
                                               class="card-link"
                                               href="<?= htmlspecialchars($project['github_link']) ?>"
                                               aria-label="Voir le GitHub du projet <?= htmlspecialchars($project['title']) ?>"
                                               target="_blank"
                                               rel="noopener noreferrer">
                                               GitHub
                                           </a>
                                       </div>
                                   <?php endif; ?>

                                   <?php if (!empty($project['project_link'])): ?>
                                       <div class="card-actions">
                                           <a
                                               class="card-link"
                                               href="<?= htmlspecialchars($project['project_link']) ?>"
                                               aria-label="Voir le projet <?= htmlspecialchars($project['title']) ?>"
                                               target="_blank"
                                               rel="noopener noreferrer">
                                               Voir le projet
                                           </a>
                                       </div>
                                   <?php endif; ?>
                               </div>
                           </article>
                       <?php endforeach; ?>
                   </div>
               <?php endif; ?>
           </div>
       </section>

       <section id="skills" class="section">
           <div class="container">
               <header class="section-header reveal">                   
                   <h2>Compétences</h2>
                   <p>Stack orientée front-end, avec bases solides côté back.</p>
               </header>

               <div class="chips-grid" aria-label="Compétences">
                   <?php foreach ($skills as $skill): ?>
                       <span class="chip reveal">
                           <?php if (!empty($skill['logo'])): ?>
                               <img
                                   loading="lazy"
                                   src="/images/<?= htmlspecialchars($skill['logo']) ?>"
                                   alt="Logo de <?= htmlspecialchars($skill['name']) ?>">
                           <?php endif; ?>
                       </span>
                   <?php endforeach; ?>
               </div>
           </div>
       </section>

       <section id="about" class="section">
           <div class="container about-grid">
               <header class="section-header reveal">                   
                   <h2>À propos</h2>
                   <p>Je privilégie des interfaces lisibles, rapides, et faciles à maintenir.</p>
               </header>

               <div class="about-card reveal">
                   <p class="about-text">
                       J’aime construire des pages qui vont droit au but&nbsp;: une hiérarchie claire, une typographie soignée,
                       et des composants réutilisables. Mon objectif&nbsp;: un rendu «&nbsp;pro&nbsp;» sans complexité inutile.
                   </p>
                   <p class="about-text">
                       Si tu veux me parler d’un projet, le plus simple est de passer par le bouton «&nbsp;Me contacter&nbsp;» ou
                       directement via le mail en pied de page.
                   </p>
                   <div class="about-stats">
                       <div class="stat">
                           <span class="stat-num">3+</span>
                           <span class="stat-label">Projets réalisés</span>
                       </div>
                       <div class="stat">
                           <span class="stat-num">6</span>
                           <span class="stat-label">Technologies</span>
                       </div>
                       <div class="stat">
                           <span class="stat-num">100</span>
                           <span class="stat-label">Score Lighthouse</span>
                       </div>
                   </div>
               </div>
           </div>
       </section>

       <section id="contact" class="section section-contact">
           <div class="container">
               <div class="contact-card reveal">
                   <div class="contact-inner">
                       <div>
                           <p class="contact-kicker">Travaillons ensemble</p>
                           <h2 class="contact-title">Un projet en tête&nbsp;?</h2>
                           <p class="contact-lead">Disponible pour des missions freelance, des collaborations ou simplement pour discuter de vos idées.</p>
                       </div>
                       <div class="contact-actions">
                           <a class="btn btn-primary btn-lg" href="mailto:guillaume.maignaut@outlook.fr">M’envoyer un email</a>
                           <a class="btn btn-ghost btn-lg" href="https://www.linkedin.com/in/guillaume-maignaut-9b3464340/" target="_blank" rel="noreferrer">LinkedIn</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </main>