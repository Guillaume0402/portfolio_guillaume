   <main>
       <section class="container-app hero-section">
           <div class="container hero-inner">
               <div class="hero-media reveal">
                   <div class="container">
                       <p class="hero-kicker">
                           <span class="hero-kicker-text">
                               <span class="hero-kicker-name">Guillaume Maignaut</span>
                               <span class="hero-kicker-role">Développeur Web</span>
                           </span>
                       </p>
                       <h1 class="hero-title">Je crée des sites internet modernes, fiables et pensés pour durer.</h1>
                       <p class="hero-subtitle">
                           En tant que développeur web, je mets l'accent sur la qualité du front-end, tout en m'appuyant sur des bases solides en back-end. J'accorde une attention particulière à la sécurité, aux performances et à la maintenabilité de chaque projet.
                       </p>

                       <div class="hero-actions">
                           <a class="btn btn-primary" href="#projects">Voir mes projets</a>
                           <a class="btn btn-ghost" href="/contact">Me contacter</a>
                       </div>

                       <div class="hero-badges" aria-label="Points forts">
                           <span class="badge">Sécurité</span>
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
                           <p class="tl"><span class="t-dim">05</span> <span class="t-str">'PHP'</span>, <span class="t-str">'Git'</span>, <span class="t-str">'Docker'</span>,</p>
                           <p class="tl"><span class="t-dim">06</span> <span class="t-str">'Linux'</span> ];</p>
                           <p class="tl t-blank"></p>
                           <p class="tl"><span class="t-dim">07</span> <span class="t-kw">public function</span> <span class="t-fn">build</span>(<span class="t-var">$idea</span>) {</p>
                           <p class="tl"><span class="t-dim">08</span> <span class="t-kw">return</span> <span class="t-str">"quelque chose de beau"</span>;</p>
                           <p class="tl"><span class="t-dim">09</span> }</p>                           
                           <p class="tl t-blank"></p>
                           <p class="tl"><span class="t-dim">10</span> <span class="t-comment">/*</span></p>
                           <p class="tl"><span class="t-dim">11</span> <span class="t-comment"> $ php -r "(new Developer)</span></p>
                           <p class="tl"><span class="t-dim">12</span> <span class="t-comment"> ->build($idea);" </span></p>
                           <p class="tl"><span class="t-dim">13</span> <span class="t-comment">*/</span></p>
                           <p class="tl"><span class="t-dim">14</span> <span class="t-ok">✓ Développement propre, structuré </span></p>
                           <p class="tl"><span class="t-dim">15</span> <span class="t-ok">✓ et évolutif</span></p>
                           <p class="tl"><span class="t-dim">16</span> <span class="t-cur">▌</span></p>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <section id="priorities" class="section section-priorities">
           <div class="container">
               <header class="section-header reveal">
                   <h2>Ce que je soigne dans chaque projet</h2>
                   <p>Des bases solides pour créer des sites agréables à utiliser, fiables et pensés pour durer.</p>
               </header>

               <div class="priorities-grid">
                   <article class="priority-card reveal">
                       <h3>Sécurité</h3>
                       <p>
                           Validation des données, protection des accès, gestion des sessions et mots de passe hashés :
                           je veille à construire des bases propres et rassurantes.
                       </p>
                   </article>

                   <article class="priority-card reveal">
                       <h3>Performance</h3>
                       <p>
                           Une structure claire, un chargement fluide et une interface réactive pour offrir une expérience
                           rapide, agréable et sans lourdeur inutile.
                       </p>
                   </article>

                   <article class="priority-card reveal">
                       <h3>Maintenabilité</h3>
                       <p>
                           Un code lisible, organisé et cohérent pour faciliter les évolutions, les corrections
                           et la vie du projet dans le temps.
                       </p>
                   </article>
               </div>
           </div>
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
                           <?php $img = $project['image'] ?? 'default.webp'; ?>

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
                                           <div class="card-description">
                                               <p class="card-text">
                                                   <?= htmlspecialchars($project['description']) ?>
                                               </p>

                                               <button type="button" class="card-text-toggle">
                                                   Lire plus
                                               </button>
                                           </div>
                                       <?php endif; ?>
                                   </div>
                               </div>

                               <?php $stacks = array_filter(array_map('trim', explode(',', $project['tech_stack'] ?? ''))); ?>

                               <div class="tag-row" aria-label="Technologies">
                                   <?php foreach ($stacks as $stack): ?>
                                       <span class="tag"><?= htmlspecialchars($stack) ?></span>
                                   <?php endforeach; ?>
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
                       J’aime concevoir des pages qui vont à l'essentiel, sans sacrifier l'esthétique ni la simplicité d'utilisation. Mon travail repose sur une hiérarchie claire, une typographie soignée et une cohérence visuelle, afin de créer des interfaces à la fois professionnelles, lisibles et efficaces. Je porte une attention particulière à la fiabilité et à la sécurité, des aspects essentiels pour une expérience utilisateur de qualité.
                   </p>
                   <p class="about-text">
                       Ce portfolio vous invite à découvrir ma démarche, mes partis pris techniques et les projets concrets que j'ai menés en développement web.
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
                           <span class="stat-num">PHP</span>
                           <span class="stat-label">MVC, validation, sécurité</span>
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
                           <p class="contact-kicker">Contact</p>
                           <h2 class="contact-title">Échanger autour de mon travail</h2>
                           <p class="contact-lead">N'hésitez pas à me contacter si vous souhaitez échanger sur mes projets, mon parcours professionnel, ou pour explorer ensemble une opportunité de collaboration.</p>
                       </div>
                       <div class="contact-actions">
                           <a class="btn btn-primary btn-lg" href="mailto:g.maignaut@gmail.com">M’envoyer un email</a>
                           <a class="btn btn-ghost btn-lg" href="https://www.linkedin.com/in/guillaume-maignaut-9b3464340/" target="_blank" rel="noreferrer">LinkedIn</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </main>