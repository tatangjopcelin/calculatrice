<?php

use PHPUnit\Framework\TestCase;

use App\BinaryCalculators;
use App\CalculRepository;

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

       
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
            ->method('execute')
            ->with([$a, $b, $operation, $result['resultat_decimal'], $result['resultat_binaire']]);

        
        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO calculs (nombre1, nombre2, operation, resultat, resultat_binaire) VALUES (?, ?, ?, ?, ?)")
            ->willReturn($stmtMock);

        
        $repo = new CalculRepository($pdoMock);
        $repo->save($a, $b, $operation, $result['resultat_decimal'], $result['resultat_binaire']);
    }

    public function testAndAvecBuilder()
    {
        require_once __DIR__ . '/Builder/CalculBuilder.php';
        $builder = new \Tests\Builder\CalculBuilder();

        $data = $builder
            ->avecA(5)          
            ->avecB(3)          
            ->avecOperation('and')
            ->build();

        $result = BinaryCalculators::calculer($data['a'], $data['b'], $data['operation']);

        $this->assertEquals(1, $result['resultat_decimal']);  
        $this->assertEquals('1', $result['resultat_binaire']);
        $this->assertEquals('AND', $result['operation']);
    }


}
