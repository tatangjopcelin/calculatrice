<?php
class BinaireConverter
{
    public static function versBinaire(?int $valeur): ?string
    {
        return is_null($valeur) ? null : decbin($valeur);
    }
}
