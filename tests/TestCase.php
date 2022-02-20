<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\AssertSchemas;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use AssertSchemas;

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        $this->setupSchemaAssertions($uses);

        return $uses;
    }
}
