<?php

namespace App\Repositories;

use PDO;

class ProjectRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $sql = "
            SELECT 
                idproject,
                title,
                description,
                github_link,
                project_link,
                image
            FROM projects
            ORDER BY idproject DESC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}