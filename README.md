CALCULATRICE-BINAIRE/
├── features/
│   ├── bootstrap/
│   │   ├── FeatureContext.php
│   ├── calculatrice.feature
│   └── calculatorHehat.feature
│
├── public/
│   ├── index.php     --> L'interface pour le formulaire de la calculatrice
│   └── resultat.php  --> L'interface pour afficher le resultat
│
├── src/
│   ├── BinaireConverter.php
│   ├── BinaryCalculators.php
│   ├── CalculRepository.php
│   ├── Database.php
│   └── Operation.php
│
├── tests/
│   ├── Builder/
│   ├── BinaryCalculatorIntegrationTest.php
│   ├── BinaryCalculatorsTestUnitaireTest.php
│   ├── BinaryCalculatorTestGuzzleHttpCrawler.php
│   └── BinaryCalculatorTestHttpClientCrawler.php
│
│
├── .phpunit.result.cache
├── composer.json
├── composer.lock
├── Makefile
├── phpunit.xml
└── README.md



Créer la table calculs dans MySQL avec Pour nom de la BD :calculatrice-binaire

CREATE TABLE calculs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre1 INT NOT NULL,
    nombre2 INT NOT NULL,
    operation VARCHAR(10) NOT NULL,
    resultat INT NOT NULL,
    resultat_binaire VARCHAR(64) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Pour lancer test : terminal
- cd calculatrice-binaire
- composer test

Pour lancer test Crawler et GuzzleHttp ou HttpClient : terminal
- cd calculatrice-binaire
- cd public
-  php -S localhost:8000
- changer de terminal
- vendor/bin/phpunit tests/BinaryCalculatorTestHttpClientCrawler.php

Pour lancer test behat: terminal
- cd calculatrice-binaire
- vendor/bin/behat