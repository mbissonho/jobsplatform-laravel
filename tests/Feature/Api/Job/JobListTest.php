<?php

namespace Tests\Feature\Api\Job;

use App\Models\Job;
use App\Models\Skill;
use Tests\TestCase;

class JobListTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Job::factory()->count(50)->create();
    }

    public function test_a_user_can_search_jobs_and_receive_a_paginable_result()
    {


        $response = $this->get(
            route('api.jobs.list', ['page' => 5])
        );

        $response
            ->assertOk()
            ->assertJsonCount(10, 'jobs')
            ->assertJsonStructure([
                'jobs' => [
                    ['id', 'title', 'created_at', 'updated_at']
                ]
            ])
            ->assertJsonPath('links.next', null);
    }

    public function test_a_user_can_search_jobs_by_skill_and_receive_a_paginable_result()
    {

        $countOfJobsThatRequireMagento2 = 5;

        $magento2Skill = Skill::factory()
            ->hasAttached(
                Job::factory()->count($countOfJobsThatRequireMagento2)
            )
            ->create([
                'name' => 'Magento 2'
            ]);

        $response = $this->get(
            route('api.jobs.list', ['page' => 1, 'skill_id' => $magento2Skill->id])
        );

        $response
            ->assertOk()
            ->assertJsonCount($countOfJobsThatRequireMagento2, 'jobs');
    }

}
