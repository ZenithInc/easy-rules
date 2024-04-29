<?php

use Zenith\EasyRules\Action;
use Zenith\EasyRules\Condition;
use Zenith\EasyRules\DefaultRulesEngine;
use Zenith\EasyRules\Fact;
use Zenith\EasyRules\Facts;
use Zenith\EasyRules\Rule;
use Zenith\EasyRules\Rules;

include "../vendor/autoload.php";

#[Rule(name: 'weather rule', description: 'if it rains then take an umbrella')]
class WeatherRule
{
    #[Condition]
    public function itRains(#[Fact(value: 'rain')] $fact, Facts $facts)
    {
        return $fact;
    }

    #[Action]
    public function takeAnUmbrella(): void
    {
        echo 'It rains, take an umbrella!';
    }
}

$facts = new Facts();
$facts->put('rain', true);

$weatherRule = new WeatherRule();
$rules = new Rules();
$rules->register($weatherRule);

$ruleEngine = new DefaultRulesEngine();
$ruleEngine->fire($rules, $facts);