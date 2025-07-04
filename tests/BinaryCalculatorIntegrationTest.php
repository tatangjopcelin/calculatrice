<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/BinaryCalculators.php';
require_once __DIR__ . '/../src/CalculRepository.php';

class BinaryCalculatorIntegrationTest extends TestCase
{
    /**
     * @dataProvider operationProvider
     */
    public function testCalculateurBinaire(int $a, int $b, string $operation, int $expectedDecimal, string $expectedBinary)
    {
        $result = BinaryCalculators::calculer($a, $b, $operation);
        $this->assertEquals($expectedDecimal, $result['resultat_decimal']);
        $this->assertEquals($expectedBinary, $result['resultat_binaire']);
    }

    public static function operationProvider(): array
    {
        return [
            [5, 3, 'and', 1, '1'],
            [5, 3, 'or', 7, '111'],
            [5, 3, 'xor', 6, '110'],
            [5, 3, '+', 8, '1000'],
            [5, 3, '-', 2, '10'],
            [5, 3, '*', 15, '1111'],
            [6, 3, '/', 2, '10'],
        ];
    }

    public function testDivisionParZero()
    {
        $this->assertNull(BinaryCalculators::calculer(5, 0, '/'));
    }

    public function testOperationInvalide()
    {
        $this->assertNull(BinaryCalculators::calculer(5, 3, 'mod'));
    }

        public function testSauvegardeAvecMock()
    {
        $a = 5;
        $b = 3;
        $operation = '+';
        $result = BinaryCalculators::calculer($a, $b, $operation);

        // Mock PDOStatement
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
            ->method('execute')
            ->with([$a, $b, $operation, $result['resultat_decimal'], $result['resultat_binaire']]);

        // Mock PDO
        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO calculs (nombre1, nombre2, operation, resultat, resultat_binaire) VALUES (?, ?, ?, ?, ?)")
            ->willReturn($stmtMock);

        // Utilisation du Repository avec le mock
        $repo = new CalculRepository($pdoMock);
        $repo->save($a, $b, $operation, $result['resultat_decimal'], $result['resultat_binaire']);
    }

}
