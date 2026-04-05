SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

USE `portfolio`;

INSERT INTO `projects` (`idproject`, `title`, `description`, `github_link`, `project_link`, `image`, `tech_stack`) VALUES
(1, 'EcoRide', 'Plateforme de covoiturage écologique full stack avec authentification sécurisée, système de crédits, gestion des trajets, rôles utilisateurs et notifications e-mail automatiques lors des demandes de participation et de leur validation.', 'https://github.com/Guillaume0402/ecoride', 'https://ecoride-app-gn-39216337ff0d.herokuapp.com/', 'ecoride.webp', 'PHP, HTML, CSS, Docker, SQL, NoSQL'),
(2, 'Tichylist', 'Application de gestion de tâches et de projets intégrant une authentification sécurisée, la création de comptes utilisateurs et un suivi structuré des listes et projets.', 'https://github.com/Guillaume0402/TickyList', NULL, 'tickylist.webp', 'PHP, HTML, CSS, Docker, SQL'),
(3, 'TutoPHP', 'Site d’apprentissage orienté PHP vanilla, créé pour rendre les notions essentielles plus accessibles à travers une présentation claire et des cas pratiques.', 'https://github.com/Guillaume0402/Tuto-php', 'https://tuto-php-19982edf3ffe.herokuapp.com/', 'tuto-php.webp', 'PHP, HTML, CSS');

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