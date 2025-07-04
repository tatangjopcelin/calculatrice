<?php
require_once 'Operation.php';
require_once 'BinaireConverter.php';

class BinaryCalculators
{
    public static function calculer(int $a, int $b, string $operation): ?array
    {
        $resultat = Operation::appliquer($a, $b, $operation);
        if (is_null($resultat)) return null;

        return [
            'nombre1_decimal' => $a,
            'nombre1_binaire' => BinaireConverter::versBinaire($a),
            'nombre2_decimal' => $b,
            'nombre2_binaire' => BinaireConverter::versBinaire($b),
            'operation' => strtoupper($operation),
            'resultat_decimal' => $resultat,
            'resultat_binaire' => BinaireConverter::versBinaire($resultat),
        ];



        
    }
}
