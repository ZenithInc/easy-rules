<?php

declare(strict_types=1);

namespace Zenith\EasyRules;

class Facts
{

    private array $arguments = [];

    public function put(string $key, mixed $value): void
    {
        $this->arguments[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $this->arguments[$key] ?? null;
    }

    public static function fromArray(array $items): self
    {
        $facts = new Facts();
        foreach ($items as $key => $value) {
            $facts->put($key, $value);
        }

        return $facts;
    }
}
