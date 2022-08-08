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

    }

    public function test_authenticated_user_cannot_apply_to_a_job()
    {
        $this->actingAs($this->user)
            ->postJson(
            "api/v1/jobs/{$this->job->id}/applications"
        )
        ->assertOk();

        $this->assertDatabaseHas('applications', ['job_id' => $this->job->id, 'user_id' => $this->user->id]);
    }

    public function test_user_receive_notfound_message_when_try_apply_a_nonexistent_job()
    {
        $this->actingAs($this->user)
            ->postJson(
                "api/v1/jobs/356/applications"
            )
            ->assertNotFound();
    }

}
