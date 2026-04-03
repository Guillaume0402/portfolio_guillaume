<?php

namespace App\Repositories;

use PDO;

class SkillsRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $sql = "
            SELECT 
                idskills,
                name,
                logo
            FROM skills
            ORDER BY idskills DESC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}