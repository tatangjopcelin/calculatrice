<?php

namespace Tests\Builder;

class CalculBuilder
{
    private int $a = 5;
    private int $b = 3;
    private string $operation = 'and';

    public function avecA(int $a): self
    {
        $this->a = $a;
        return $this;
    }

    public function avecB(int $b): self
    {
        $this->b = $b;
        return $this;
    }

    public function avecOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function build(): array
    {
        return [
            'a' => $this->a,
            'b' => $this->b,
            'operation' => $this->operation,
        ];
    }
}
