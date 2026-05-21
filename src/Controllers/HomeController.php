<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\AbstractController;
use App\Repositories\ProjectRepository;
use App\Services\Database;
use App\Repositories\SkillsRepository;

final class HomeController extends AbstractController
{
    public function index(): string
    {
        return $this->render('home/index', [
            'pageTitle' => 'Guillaume Maignaut | Création de sites web freelance',
            'pageDescription' => 'Création de sites vitrines, landing pages et refontes web pour indépendants, artisans et petites entreprises. Portfolio, offres et contact.',
            'pageCanonical' => 'https://guillaumemaignaut.com/',
        ]);
    }

    public function portfolio(): string
    {
        $projectRepository = new ProjectRepository(Database::getConnection());
        $projects = $projectRepository->findAll();
        $skillsRepository = new SkillsRepository(Database::getConnection());
        $skills = $skillsRepository->findAll();

        return $this->render('portfolio/index', [
            'pageTitle' => 'Réalisations | Guillaume Maignaut',
            'pageDescription' => 'Découvrez les réalisations web de Guillaume Maignaut : sites, applications, interfaces et projets PHP, JavaScript, HTML, Sass et MySQL.',
            'pageCanonical' => 'https://guillaumemaignaut.com/portfolio',
            'projects' => $projects,
            'skills' => $skills,
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
