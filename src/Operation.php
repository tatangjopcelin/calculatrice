<?php
class Operation
{
    public static function appliquer(int $a, int $b, string $operation): ?int
    {
        return match ($operation) {
            'and' => $a & $b,
            'or'  => $a | $b,
            'xor' => $a ^ $b,
            '+'   => $a + $b,
            '-'   => $a - $b,
            '*'   => $a * $b,
            '/'   => $b !== 0 ? intdiv($a, $b) : null,
            default => null,
        };
    }
}
