<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

use App\BinaryCalculators;


class FeatureContext implements Context
{
    private int $a;
    private int $b;
    private string $operation;
    private ?array $result;

    /**
     * @Given je saisis :a et :b
     */
    public function jeSaisisEt(int $a, int $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * @When je choisis l'opération :operation
     */
    public function jeChoisisLOperation(string $operation)
    {
        $this->operation = $operation;
        $this->result = BinaryCalculators::calculer($this->a, $this->b, $this->operation);
    }

    /**
     * @Then le résultat binaire doit être :expectedBinary
     */
    public function leResultatBinaireDoitEtre(string $expectedBinary)
    {
        Assert::assertNotNull($this->result, "Le résultat ne doit pas être null");
        Assert::assertEquals($expectedBinary, $this->result['resultat_binaire']);
    }

    /**
     * @Then le résultat décimal doit être :expectedDecimal
     */
    public function leResultatDecimalDoitEtre(int $expectedDecimal)
    {
        Assert::assertNotNull($this->result, "Le résultat ne doit pas être null");
        Assert::assertEquals($expectedDecimal, $this->result['resultat_decimal']);
    }

    
}
