<?php
use App\BinaryCalculators;
use App\CalculRepository;
use App\Database;
require_once __DIR__ . '/../src/BinaryCalculators.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/CalculRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (int) $_POST['nombre1'];
    $b = (int) $_POST['nombre2'];
    $operation = $_POST['operation'];

    $resultat = BinaryCalculators::calculer($a, $b, $operation);
    if ($resultat === null || $resultat['resultat_decimal'] === null) {
        echo "<div class='result' style='
            margin: 100px auto;
            max-width: 400px;
            background-color: #ffe6e6;
            border: 1px solid #ff4d4d;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-family: Arial, sans-serif;
        '>
            <h3 style='color: #cc0000;'>Erreur : Division par zéro impossible.</h3>
            <a href='index.php' style='
                display: inline-block;
                margin-top: 15px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            '>Retour au formulaire</a>
        </div>";
        exit;
    }
    
    

    $db = new Database();
    $pdo = $db->getConnection();
    $repo = new CalculRepository($pdo);
    $repo->save(
        $resultat['nombre1_decimal'],
        $resultat['nombre2_decimal'],
        $resultat['operation'],
        $resultat['resultat_decimal'],
        $resultat['resultat_binaire']
    );
} else {
   
    header('Location: index.php');
    exit;
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat Calculatrice</title>
    <style>
       body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #83a4d4, #b6fbff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffffcc;
            margin-top: 50px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #444;
        }

        input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
            font-size: 16px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        .result {
            background-color: #e3f2fd;
            padding: 20px;
            margin-top: 25px;
            border-radius: 10px;
            border: 1px solid #90caf9;
        }

        .result h3 {
            margin-top: 0;
            color: #1976d2;
        }

        .result p {
            margin: 8px 0;
            font-size: 16px;
        }

        strong {
            color: #000;
        }
        .btn-retour {
            margin-top: 30px;
            display: block;
            width: 100%;
            background: #0056b3;
            color: white;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn-retour:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Résultat du calcul</h2>
        <div class="result">
            <p><strong>Nombre 1 :</strong> <?= $resultat['nombre1_decimal'] ?> (<?= $resultat['nombre1_binaire'] ?>)</p>
            <p><strong>Nombre 2 :</strong> <?= $resultat['nombre2_decimal'] ?> (<?= $resultat['nombre2_binaire'] ?>)</p>
            <p><strong>Opération :</strong> <?= $resultat['operation'] ?></p>
            <?php if ($resultat['resultat_decimal'] === null): ?>
            <p style="color:red;"><strong>Erreur :</strong> Division par zéro !</p>
        <?php else: ?>
            <p><strong>Résultat :</strong> <?= $resultat['resultat_decimal'] ?> (<?= $resultat['resultat_binaire'] ?>)</p>
        <?php endif; ?>

        </div>
         <a href="index.php" class="btn-retour"> Retour à la calculatrice </a>
    </div>
</body>
</html>
