<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\AbstractController;
use App\Repositories\ProjectRepository;
use App\Services\Database;

final class HomeController extends AbstractController
{
    public function index(): string
    {
        return $this->render('home/index', [
            'pageTitle' => 'Création de sites vitrines pour artisans dans le Gers | Guillaume Maignaut',
            'pageDescription' => 'Création de sites vitrines et landing pages clairs, rapides et responsive pour indépendants, artisans et petites entreprises. Démos, tarifs et contact.',
            'pageCanonical' => 'https://guillaumemaignaut.com/',
        ]);
    }

    public function portfolio(): string
    {
        $projectRepository = new ProjectRepository(Database::getConnection());
        $projects = $projectRepository->findAll();

        return $this->render('portfolio/index', [
            'pageTitle' => 'Projets techniques | Guillaume Maignaut',
            'pageDescription' => 'Une sélection de projets web techniques montrant la structuration d’interfaces, la gestion de données et la construction de code maintenable.',
            'pageCanonical' => 'https://guillaumemaignaut.com/portfolio',
            'projects' => $projects,
        ]);
    }

    public function about(): string
    {
        return $this->render('home/index', [
            'pageTitle' => 'À propos',
            'title' => 'À propos',
            'subtitle' => 'Page about OK',
        ]);
    }

  
}
