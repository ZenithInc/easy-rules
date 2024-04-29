<?php

declare(strict_types=1);

namespace Zenith\EasyRules;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class DefaultRulesEngine
{

    /**
     * The fire method is used to iterate through a collection of rules and perform a specific action on each rule.
     *
     * @param Rules $rules The collection of rules to iterate through.
     * @param Facts $facts The facts necessary for performing the action on each rule.
     *
     * @return void
     * @throws ReflectionException
     */
    public function fire(Rules $rules, Facts $facts): void
    {
        foreach ($rules->getRules() as $rule) {
            $reflectionRule = new ReflectionClass($rule);
            $methods = $reflectionRule->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Condition::class);
                if (empty($attributes)) {
                    continue;
                }
                $parameters = $method->getParameters();
                $args = [];
                $hasFact = false;
                foreach ($parameters as $parameter) {
                    $factAttributes = $parameter->getAttributes(Fact::class);
                    if (!empty($factAttributes)) {
                        $key = $factAttributes[0]->newInstance()->value;
                        $args[$parameter->getName()] = $facts->get($key);
                        $hasFact = true;
                        continue;
                    }
                    if ($parameter->getType()->getName() === Facts::class) {
                        $args[$parameter->getName()] = $facts;
                    }
                }
                if (!$hasFact) {
                    continue;
                }
                $result = $method->invokeArgs($rule, $args);
                if ($result) {
                    foreach ($methods as $m) {
                        if ($m->getAttributes(Action::class)) {
                            $m->invoke($rule);
                        }
                    }
                }
            }
        }
    }
}
