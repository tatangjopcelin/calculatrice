<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

use App\BinaryCalculators;

class FeatureContext implements Context
{
    //  Partie logique métier (tests unitaires) 
    private int $a;
    private int $b;
    private string $operation;
    private ?array $result;

    //  Partie end-to-end formulaire (tests E2E) 
    private HttpBrowser $client;
    private Crawler $crawler;

    public function __construct()
    {
        // Initialisation du client HTTP pour les tests E2E
        $this->client = new HttpBrowser(HttpClient::create());
    }

    // TESTS DE LA LOGIQUE (sans interface)

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

    //  TESTS END-TO-END AVEC LE FORMULAIRE 

    /**
     * @When je remplis le formulaire avec :a et :b et l'opération :operation
     */
    public function jeRemplisLeFormulaireAvecEtEtLOperation($a, $b, $operation)
    {
        $this->crawler = $this->client->request('GET', 'http://localhost:8000/index.php');

        $form = $this->crawler->selectButton('Calculer')->form([
            'nombre1' => $a,
            'nombre2' => $b,
            'operation' => strtolower($operation),
        ]);

        $this->crawler = $this->client->submit($form);
    }

    /**
     * @Then le résultat affiché doit contenir :texte
     */
    public function leResultatAfficheDoitContenir($texte)
{
    $result = $this->crawler->filter('.result')->text();
    Assert::assertStringContainsStringIgnoringCase($texte, $result);
}


    /**
     * @Then je devrais voir le résultat binaire :expected
     */
    public function jeDevraisVoirLeResultatBinaire($expected)
    {
        $result = $this->crawler->filter('.result')->text();

        Assert::assertStringContainsString($expected, $result);
    }
}
