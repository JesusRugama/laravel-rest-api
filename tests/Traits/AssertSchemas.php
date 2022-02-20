<?php

declare(strict_types=1);

namespace Tests\Traits;

use EnricoStahn\JsonAssert\Assert as JsonAssert;
use Illuminate\Testing\TestResponse;

Trait AssertSchemas
{
    /**
     * Sets up helpes for Schemas assertation
     * from estahn/phpunit-json-assertions
     *
     * @return void
     */
    public function setupSchemaAssertions(): void
    {
        $assertSchema = function(string $name, object $data): void {
            JsonAssert::assertJsonMatchesSchema(
                $data,
                base_path('tests/Schemas/' . $name)
            );
        };

        TestResponse::macro(
            'assertSchemaCollection',
            function (string $name) use ($assertSchema): TestResponse {
                $data = $this->getData();
                $data = $data->data ?? $data;
                foreach ($data as $datum) {
                    $assertSchema($name, $datum);
                }

                return $this;
            }
        );

        TestResponse::macro(
            'assertSchemaResource',
            function (string $name) use ($assertSchema): TestResponse {
                $data = $this->getData();
                $data = $data->data ?? $data;
                $assertSchema($name, $data);

                return $this;
            }
        );
    }
}
