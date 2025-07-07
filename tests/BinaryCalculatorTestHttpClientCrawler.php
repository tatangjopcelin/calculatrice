<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use PHPUnit\Framework\Assert;

class BinaryCalculatorTestHttpClientCrawler extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new HttpBrowser(HttpClient::create());
    }

    private function submitFormAndGetResult(string $a, string $b, string $operation): string
    {
        $crawler = $this->client->request('GET', 'http://localhost:8000/index.php');

        $form = $crawler->selectButton('Calculer')->form([
            'nombre1' => $a,
            'nombre2' => $b,
            'operation' => strtolower($operation),
        ]);
        var_dump($form->getValues());

        $resultCrawler = $this->client->submit($form);

        // On suppose qu'on a <div id="resultat">...</div>
        return $resultCrawler->filter('.result')->text();
    }

    public function testAddition()
    {
        $result = $this->submitFormAndGetResult('5', '3', '+');
        Assert::assertStringContainsString('1000', $result);
    }

    public function testSoustraction()
    {
        $result = $this->submitFormAndGetResult('7', '2', '-');
        Assert::assertStringContainsString('101', $result); 
    }

    public function testMultiplication()
    {
        $result = $this->submitFormAndGetResult('3', '4', '*');
        Assert::assertStringContainsString('1100', $result); 
    }

    public function testDivision()
    {
        $result = $this->submitFormAndGetResult('8', '2', '/');
        Assert::assertStringContainsString('100', $result); 
    }

    public function testAnd()
    {
        $result = $this->submitFormAndGetResult('6', '3', 'AND');
        Assert::assertStringContainsString('10', $result); 
    }

    public function testOr()
    {
        $result = $this->submitFormAndGetResult('6', '3', 'OR');
        Assert::assertStringContainsString('111', $result); 
    }

    public function testXor()
    {
        $result = $this->submitFormAndGetResult('6', '3', 'XOR');
        Assert::assertStringContainsString('101', $result); 
    }

}
