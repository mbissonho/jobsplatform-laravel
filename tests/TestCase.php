<?php

namespace Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Feature\AssertsPagination;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, LazilyRefreshDatabase, AssertsPagination;
}
