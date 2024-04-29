<?php

declare(strict_types=1);

namespace Zenith\EasyRules;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class Fact
{

    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
