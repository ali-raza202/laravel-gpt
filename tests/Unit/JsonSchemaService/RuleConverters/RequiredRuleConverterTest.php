<?php

namespace MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService\RuleConverters;

use MalteKuhr\LaravelGPT\Services\JsonSchemaService\JsonSchemaService;
use MalteKuhr\LaravelGPT\Tests\Support\TestSchema;
use MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService\RuleConverterTestCase;
use Throwable;

class RequiredRuleConverterTest extends RuleConverterTestCase
{
    /**
     * @return array{rules: string|array, result: array|TestSchema|Throwable}[]
     */
    public function casesProvider(): array
    {
        return [
            [
                'rules' => 'required',
                'result' => TestSchema::make()->required(),
            ]
        ];
    }

    public function test_if_required_is_compatible_with_array_items()
    {
        $this->expectExceptionMessage('The required rule cannot be applied to array items. Use the min and max rules instead.');

        JsonSchemaService::convert([
            'test' => 'required',
            'test.*' => 'required|in:foo,bar',
        ]);
    }
}