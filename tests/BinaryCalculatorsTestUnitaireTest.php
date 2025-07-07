<?php

use PHPUnit\Framework\TestCase;
use App\BinaryCalculators;

class BinaryCalculatorsTestUnitaireTest extends TestCase
{
    public function testAddition()
    {
        $result = BinaryCalculators::calculer(3, 5, '+');
        

        $this->assertEquals(3, $result['nombre1_decimal']);
        $this->assertEquals('11', $result['nombre1_binaire']);

        $this->assertEquals(5, $result['nombre2_decimal']);
        $this->assertEquals('101', $result['nombre2_binaire']);

        $this->assertEquals(8, $result['resultat_decimal']);
        $this->assertEquals('1000', $result['resultat_binaire']);
    }

    public function testDivisionParZero()
    {
        $result = BinaryCalculators::calculer(10, 0, '/');
        $this->assertNull($result);
    }

    public function testOperationInvalide()
    {
        $result = BinaryCalculators::calculer(2, 2, 'INVALID');
        $this->assertNull($result);
    }

    public function testAndOperation()
    {
        $result = BinaryCalculators::calculer(6, 3, 'and');
        $this->assertEquals(2, $result['resultat_decimal']);
        $this->assertEquals('10', $result['resultat_binaire']);
    }

    public function testXorOperation()
    {
        $result = BinaryCalculators::calculer(6, 3, 'xor');
        $this->assertEquals(5, $result['resultat_decimal']);
        $this->assertEquals('101', $result['resultat_binaire']);
    }
}
