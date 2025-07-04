<?php
namespace App;
class CalculRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(int $a, int $b, string $operation, int $decimalResult, string $binaryResult): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO calculs (nombre1, nombre2, operation, resultat, resultat_binaire) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$a, $b, $operation, $decimalResult, $binaryResult]);
    }
}

