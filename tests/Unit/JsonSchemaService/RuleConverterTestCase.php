<?php

namespace MalteKuhr\LaravelGPT\Tests\Unit\JsonSchemaService;

use MalteKuhr\LaravelGPT\Services\JsonSchemaService\JsonSchemaService;
use MalteKuhr\LaravelGPT\Tests\Support\TestSchema;
use MalteKuhr\LaravelGPT\Tests\TestCase;
use Throwable;

abstract class RuleConverterTestCase extends TestCase
{
    /**
     * @dataProvider casesProvider
     */
    public function test_if_rule_converter_behaves_as_expected($rules, $expected): void
    {
        try {
            $result = JsonSchemaService::convert([
                'test' => $rules
            ]);
        } catch (Throwable $exception) {
            if (is_string($expected)) {
                $this->assertInstanceOf($expected, $exception);
                return;
            } else if ($expected instanceof Throwable) {
                $result = $exception;
            } else {
                throw $exception;
            }
        }

        if ($expected instanceof TestSchema) {
            $expected = $expected->toArray();
        }

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array{rules: string|array, result: array|TestSchema|Throwable}[]
     */
    abstract public function casesProvider(): array;
}
