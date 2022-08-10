<?php

namespace Tests\Feature\Api\Job;

use App\Models\User;
use App\Models\Job;
use Tests\TestCase;

class ApplyingForJobTest extends TestCase
{
    private User $user;

    private Job $job;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->job = Job::factory()->create();
    }

    public function test_unauthenticated_user_cannot_apply_to_a_job()
    {
        $this->postJson(
            route('api.jobs.candidate.apply-to-job', ['job' => $this->job->id]),
            )
            ->assertUnauthorized()
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_user_can_apply_to_a_job()
    {
        $this->actingAs($this->user)
            ->postJson(
            route('api.jobs.candidate.apply-to-job', ['job' => $this->job->id]),
        )
        ->assertOk();

        $this->assertDatabaseHas('applications', ['job_id' => $this->job->id, 'user_id' => $this->user->id]);
    }

    public function test_user_receive_notfound_message_when_try_apply_a_nonexistent_job()
    {
        $this->actingAs($this->user)
            ->postJson(
                route('api.jobs.candidate.apply-to-job', ['job' => 356]),
                [],
                [
                    ['accept' => 'application/json']
                ]
            )
            ->assertNotFound()
            ->assertSee('Not Found');
    }

}
