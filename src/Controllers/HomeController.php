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
        $projectRepository = new ProjectRepository(Database::getConnection());
        $projects = $projectRepository->findAll();

        return $this->render('home/index', [
            'pageTitle' => 'Accueil',
            'title' => 'Accueil',
            'subtitle' => 'Routeur + layout OK',
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