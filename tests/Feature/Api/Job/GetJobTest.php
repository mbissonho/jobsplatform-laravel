<?php

namespace Tests\Feature\Api\Job;

use App\Models\Job;
use Tests\TestCase;

class GetJobTest extends TestCase
{
    public function test_user_can_access_job_details()
    {
        $job = Job::factory()->create();

        $this->getJson(
            route('api.jobs.get-by-id', ['job' => $job->id ])
        )
        ->assertOk()
        ->assertSee(['description', $job->description]);
    }
}
