<?php

namespace App\Domain\Medicine\ValueObjects;

class Price
{
    private float $value;

    public function __construct(float $price)
    {
        $this->validate($price);
        $this->value = round($price, 2);
    }

    private function validate(float $price): void
    {
        if ($price < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        if ($price > 999999.99) {
            throw new \InvalidArgumentException('Price cannot exceed 999,999.99');
        }
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function multiply(int $quantity): Price
    {
        return new Price($this->value * $quantity);
    }

    public function add(Price $other): Price
    {
        return new Price($this->value + $other->value);
    }

    public function subtract(Price $other): Price
    {
        $result = $this->value - $other->value;
        if ($result < 0) {
            throw new \InvalidArgumentException('Result cannot be negative');
        }
        return new Price($result);
    }

    public function equals(Price $other): bool
    {
        return abs($this->value - $other->value) < 0.01;
    }

    public function format(): string
    {
        return 'Rp ' . number_format($this->value, 0, ',', '.');
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
} 