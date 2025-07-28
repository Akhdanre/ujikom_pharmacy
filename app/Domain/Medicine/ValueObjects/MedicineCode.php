<?php

namespace App\Domain\Medicine\ValueObjects;

class MedicineCode
{
    private string $value;

    public function __construct(string $code)
    {
        $this->validate($code);
        $this->value = strtoupper(trim($code));
    }

    private function validate(string $code): void
    {
        if (empty(trim($code))) {
            throw new \InvalidArgumentException('Medicine code cannot be empty');
        }

        if (strlen($code) < 3) {
            throw new \InvalidArgumentException('Medicine code must be at least 3 characters');
        }

        if (strlen($code) > 20) {
            throw new \InvalidArgumentException('Medicine code cannot exceed 20 characters');
        }

        if (!preg_match('/^[A-Z0-9\-_]+$/', strtoupper($code))) {
            throw new \InvalidArgumentException('Medicine code can only contain letters, numbers, hyphens and underscores');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(MedicineCode $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
} 