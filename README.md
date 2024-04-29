## Easy Rule Engine

Easy Rules is a PHP rules engine inspired by the [easy-rules](https://github.com/j-easy/easy-rules) project in java.

## Example

### 1. First, define your rule...

Either in a declarative way using annotations:
```php
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
```
### 2. Then, fire it!

Then ...
```php
$facts = new Facts();
$facts->put('rain', true);

$weatherRule = new WeatherRule();
$rules = new Rules();
$rules->register($weatherRule);

$ruleEngine = new DefaultRulesEngine();
$ruleEngine->fire($rules, $facts);
```

## License

Easy Rules released under the terms of the MIT license:
```text
The MIT License (MIT)

Copyright (c) 2024 Zenith Tech (happy@hacking.icu)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```