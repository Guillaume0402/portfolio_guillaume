SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

USE `portfolio`;

INSERT INTO `projects` (`idproject`, `title`, `description`, `github_link`, `project_link`, `image`, `tech_stack`) VALUES
(1, 'EcoRide', 'Projet full stack avec rôles utilisateurs, trajets, crédits et notifications. Il montre ma capacité à gérer une logique métier plus complète qu’un simple site vitrine.', 'https://github.com/Guillaume0402/ecoride', 'https://ecoride-app-gn-39216337ff0d.herokuapp.com/', 'ecoride.webp', 'PHP, HTML, CSS, Docker, SQL, NoSQL'),
(2, 'Tichylist', 'Application de gestion de tâches avec comptes utilisateurs, authentification et suivi de projets. Ce projet montre ma capacité à structurer une application avec espace privé et données sécurisées.', 'https://github.com/Guillaume0402/TickyList', NULL, 'tickylist.webp', 'PHP, HTML, CSS, Docker, SQL'),
(3, 'TutoPHP', 'Site pédagogique autour de PHP vanilla, pensé pour rendre des notions techniques accessibles. Il montre ma capacité à organiser du contenu, clarifier un parcours et construire une interface lisible.', 'https://github.com/Guillaume0402/Tuto-php', 'https://tuto-php-19982edf3ffe.herokuapp.com/', 'tuto-php.webp', 'PHP, HTML, CSS');

INSERT INTO `skills` (`idskills`, `name`, `logo`) VALUES
(1, 'PHP', 'phpsbg.webp'),
(2, 'HTML', 'htmlsbg.webp'),
(3, 'CSS', 'csssbg.webp'),
(4, 'JAVASCRIPT', 'jssbg.webp'),
(5, 'SASS', 'sasssbg.webp'),
(6, 'SQL', 'sqlsbg.webp'),
(7, 'DOCKER', 'dockersbg.webp'),
(8, 'NOSQL', 'nosqlsbg.webp'),
(9, 'LINUX', 'linuxsbg.webp');
