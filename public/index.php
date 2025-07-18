




<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calculatrice Binaire</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Calculatrice Bin (AND, OR, XOR, +, -, x, /)</h2>
        <form method="POST" action="resultat.php">
            <label for="nombre1">Nombre 1 (décimal) :</label>
            <input type="number" name="nombre1" id="nombre1" required>

            <label for="nombre2">Nombre 2 (décimal) :</label>
            <input type="number" name="nombre2" id="nombre2" required>

            <label for="operation">Opération :</label>
            <select name="operation" id="operation" required>
                <option value="and">AND</option>
                <option value="or">OR</option>
                <option value="xor">XOR</option>
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>

            <button type="submit">Calculer</button>
        </form>
    </div>
</body>
</html>


