<?php

declare(strict_types=1);

namespace Zenith\EasyRules;

class Rules
{

    private array $rules = [];

    public function register(object $rule): void
    {
        $this->rules[] = $rule;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
