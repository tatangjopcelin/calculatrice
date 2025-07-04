<?php


use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/BinaryCalculators.php';

class BinaryCalculatorTest extends TestCase
{
    public function testAndOperation()
    {
        $result = BinaryCalculators::calculer(5, 3, 'and');
        $this->assertEquals(1, $result['resultat_decimal']);
        $this->assertEquals('1', $result['resultat_binaire']);
    }

    public function testOrOperation()
    {
        $result = BinaryCalculators::calculer(5, 3, 'or');
        $this->assertEquals(7, $result['resultat_decimal']);
        $this->assertEquals('111', $result['resultat_binaire']);
    }

    public function testXorOperation()
    {
        $result = BinaryCalculators::calculer(5, 3, 'xor');
        $this->assertEquals(6, $result['resultat_decimal']);
        $this->assertEquals('110', $result['resultat_binaire']);
    }

    public function testOperationInvalide()
    {
        $result = BinaryCalculators::calculer(5, 3, 'not');
        $this->assertNull($result);
    }

    public function testAddition()
    {
        $result = BinaryCalculators::calculer(5, 3, '+');
        $this->assertEquals(8, $result['resultat_decimal']);
        $this->assertEquals('1000', $result['resultat_binaire']);
    }

    public function testSoustraction()
    {
        $result = BinaryCalculators::calculer(5, 3, '-');
        $this->assertEquals(2, $result['resultat_decimal']);
        $this->assertEquals('10', $result['resultat_binaire']);
    }

    public function testMultiplication()
    {
        $result = BinaryCalculators::calculer(5, 3, '*');
        $this->assertEquals(15, $result['resultat_decimal']);
        $this->assertEquals('1111', $result['resultat_binaire']);
    }

    public function testDivision()
    {
        $result = BinaryCalculators::calculer(6, 3, '/');
        $this->assertEquals(2, $result['resultat_decimal']);
        $this->assertEquals('10', $result['resultat_binaire']);
    }

    public function testDivisionParZero()
    {
        $result = BinaryCalculators::calculer(5, 0, '/');
        $this->assertNull($result);
    }
}
