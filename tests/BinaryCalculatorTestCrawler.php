<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client([
'base_uri' => 'http://localhost:8000/',]);

function testCalcul($nombre1, $nombre2, $operation, $attendu_decimal, $attendu_binaire) {
    global $client;

    echo "Test : $nombre1 $operation $nombre2 => $attendu_decimal ($attendu_binaire)\n";

    $response = $client->post('resultat.php', [
        'form_params' => [
            'nombre1' => $nombre1,
            'nombre2' => $nombre2,
            'operation' => $operation,
        ]
    ]);
    

    $html = (string) $response->getBody();
    $crawler = new Crawler($html);

    $resultText = $crawler->filter('.result')->text();

    if (str_contains($resultText, "$attendu_decimal ($attendu_binaire)")) {
        echo "✅ OK\n\n";
    } else {
        echo " ECHEC : résultat inattendu.\n";
        echo " Contenu extrait :\n$resultText\n\n";
    }
}


testCalcul(3, 5, '+', 8, '1000');
testCalcul(6, 2, '-', 4, '100');
testCalcul(4, 2, '*', 8, '1000');
 testCalcul(8, 2, '/', 4, '100');
testCalcul(6, 3, 'and', 2, '10');
testCalcul(6, 3, 'or', 7, '111');
testCalcul(6, 3, 'xor', 5, '101');



