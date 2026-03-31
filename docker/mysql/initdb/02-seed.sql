USE `portfolio`;

INSERT INTO `projects` (`idproject`, `title`, `description`, `github_link`, `project_link`, `image`) VALUES
(1, 'EcoRide', 'Plateforme de covoiturage basé sur l\'écologie', 'https://github.com/Guillaume0402/ecoride', 'https://ecoride-app-gn-39216337ff0d.herokuapp.com/', 'ecoride.png'),
(2, 'Tickylist', 'Application de gestion de projet', 'https://github.com/Guillaume0402/TickyList', NULL, 'tutoPHP'),
(3, 'TutoPHP', 'Site d\'apprentissage de PHP', 'https://github.com/Guillaume0402/Tuto-php', 'https://tuto-php-19982edf3ffe.herokuapp.com/', 'tuto-php.png');

INSERT INTO `skills` (`idskills`, `name`, `logo`) VALUES
(1, 'PHP', 'phpsbg.png'),
(2, 'HTML', 'htmlsbg.png'),
(3, 'CSS', 'csssbg.png'),
(4, 'JAVASCRIPT', 'jssbg.png'),
(5, 'SASS', 'sasssbg.png'),
(6, 'SQL', 'sqlsbg.png'),
(7, 'DOCKER', 'dockersbg.png'),
(8, 'NOSQL', 'nosqlsbg.png');