<?php

declare(strict_types=1);

namespace Zenith\EasyRules;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Rule
{

    public string $name;

    public string $description;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
}
