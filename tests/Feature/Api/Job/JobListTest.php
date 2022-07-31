<?php

namespace Tests\Feature\Api\Job;

use App\Models\Job;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class JobListTest extends TestCase
{

    public function test_jobs_are_fetched_as_json()
    {

        Job::factory()->count(5)->create();

        $response = $this->get(route('api.jobs.list'));

        $response->assertOk()
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('jobs'));

    }
}
