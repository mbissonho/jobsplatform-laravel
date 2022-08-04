<?php

namespace Tests\Feature\Api\Job;

use App\Models\Job;
use App\Models\Skill;
use Tests\TestCase;
use Illuminate\Testing\TestResponse;

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

        $this->assertSeePaginationJsonProperties($response);
    }

    public function test_a_user_can_search_jobs_by_skill_and_receive_a_paginable_result()
    {
        $countOfJobsThatRequireMagento2Skill = 5;

        $magento2Skill = Skill::factory()
            ->hasAttached(
                Job::factory()->count($countOfJobsThatRequireMagento2Skill)
            )
            ->createOne([
                'name' => 'Magento 2'
            ]);

        $response = $this->get(
            route('api.jobs.list', ['page' => 1, 'skill_id' => $magento2Skill->id])
        );

        $response
            ->assertOk()
            ->assertJsonCount($countOfJobsThatRequireMagento2Skill, 'jobs');

        $this->assertSeePaginationJsonProperties($response);
    }

    public function test_user_can_search_jobs_by_several_criteria()
    {
        //Create two Magento 2 remote jobs
        //One from big company and another from startup
        $magento2Skill = Skill::factory()->createOne([
            'name' => 'Magento 2'
        ]);

        $remoteBigCompanyJob = Job::factory()
            ->remote()
            ->fromBigCompany()
            ->createOne();

        $remoteStartupJob = Job::factory()
            ->remote()
            ->fromStartup()
            ->createOne();

        //Create one Magento 2 on-site job

        $onSiteStartupJob = Job::factory()
            ->remote(false)
            ->fromStartup()
            ->createOne();

        $magento2Skill->jobs()->attach([
            $remoteBigCompanyJob->id,
            $remoteStartupJob->id,
            $onSiteStartupJob->id
        ]);

        $responseTwoRemoteMagento2Jobs = $this->get(
            route('api.jobs.list', ['page' => 1, 'remote' => 1, 'skill_id' => $magento2Skill->id])
        );

        $responseTwoRemoteMagento2Jobs
            ->assertOk()
            ->assertJsonCount(2, 'jobs');
    }

    private function assertSeePaginationJsonProperties(TestResponse $response)
    {
        $response
            ->assertSee('links')
            ->assertSee('meta');
    }

}
