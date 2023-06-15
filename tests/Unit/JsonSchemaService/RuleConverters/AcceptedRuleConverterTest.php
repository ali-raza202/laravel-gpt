<?php

namespace MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService\RuleConverters;

use MalteKuhr\LaravelGPT\Tests\Support\TestSchema;
use MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService\RuleConverterTestCase;
use Throwable;

class AcceptedRuleConverterTest extends RuleConverterTestCase
{
    /**
     * @return array{rules: string|array, result: array|TestSchema|Throwable}[]
     */
    public function casesProvider(): array
    {
        return [
            [
                'rules' => 'boolean|accepted',
                'result' => TestSchema::make()->set('type', 'boolean')->set('description', 'Acceptance is required! Accepted value is true.'),
            ],
            [
                'rules' => 'string|accepted',
                'result' => TestSchema::make()->set('type', 'string')->set('description', "Acceptance is required! Accepted values are 'yes', 'on', 1 and true."),
            ],
            [
                'rules' => ['accepted', 'required'],
                'result' => TestSchema::make()->set('type', 'string')->set('description', "Acceptance is required! Accepted values are 'yes', 'on', 1 and true.")->required(),
            ],
        ];
    }
}