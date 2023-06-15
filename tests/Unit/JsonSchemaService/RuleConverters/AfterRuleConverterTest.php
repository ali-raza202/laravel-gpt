<?php

namespace MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService\RuleConverters;

use Carbon\Exceptions\InvalidFormatException;
use MalteKuhr\LaravelGPT\Exceptions\JsonSchemaService\FieldSetException;
use MalteKuhr\LaravelGPT\Tests\Support\TestSchema;
use MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService\RuleConverterTestCase;
use Throwable;

class AfterRuleConverterTest extends RuleConverterTestCase
{
    /**
     * @return array{rules: string|array, result: array|TestSchema|Throwable}[]
     */
    public function casesProvider(): array
    {
        return [
            [
                'rules' => 'after:2021-01-01',
                'result' => TestSchema::make()
                    ->set('type', 'string')
                    ->set('format', 'date')
                    ->set('description', 'Must be a date after 2021-01-01.'),
            ],
            [
                'rules' => 'after:some_bullshit',
                'result' => InvalidFormatException::class
            ],
            [
                'rules' => 'after:today',
                'result' => TestSchema::make()
                    ->set('type', 'string')
                    ->set('format', 'date')
                    ->set('description', 'Must be a date after ' . now()->format('Y-m-d') . '.'),
            ],
            [
                'rules' => 'integer|after:today',
                'result' => FieldSetException::class
            ],
        ];
    }
}