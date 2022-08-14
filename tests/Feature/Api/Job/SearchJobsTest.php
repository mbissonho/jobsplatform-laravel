<?php

namespace Tests\Feature\Api\Job;

use App\Models\CompanySize;
use App\Models\ContractType;
use App\Models\ExperienceLevel;
use App\Models\Job;
use App\Models\Skill;
use Tests\TestCase;

class SearchJobsTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Job::factory()->count(50)->create();
    }

    public function test_user_can_search_jobs_and_receive_a_paginable_result()
    {
        $response = $this->getJson(
            route('api.jobs.search', ['page' => 5])
        );

        $response
            ->assertOk()
            ->assertJsonCount(10, 'jobs')
            ->assertJsonStructure([
                'jobs' => [
                    ['id', 'title']
                ]
            ])
            ->assertJsonPath('links.next', null);

        $this->assertSeePaginationJsonProperties($response);
    }

    public function test_user_can_search_jobs_by_skill_and_receive_a_paginable_result()
    {
        $countOfJobsThatRequireMagento2Skill = 5;

        $magento2Skill = Skill::factory()
            ->hasAttached(
                Job::factory()->count($countOfJobsThatRequireMagento2Skill)
            )
            ->createOne([
                'name' => 'Magento 2'
            ]);

        $response = $this->getJson(
            route('api.jobs.search', ['page' => 1, 'skill_id' => $magento2Skill->id])
        );

        $response
            ->assertOk()
            ->assertJsonCount($countOfJobsThatRequireMagento2Skill, 'jobs');

        $this->assertSeePaginationJsonProperties($response);
    }

    public function test_user_can_search_jobs_by_several_criteria()
    {
        $this->seed();

        $magento2Skill = Skill::query()
            ->where('name','=','Magento 2')
            ->first();

        // Assert can search two magento 2 remote jobs

        $responseTwoRemoteMagento2Jobs = $this->getJson(
            route('api.jobs.search', ['remote' => 1, 'skill_id' => $magento2Skill->id])
        );

        $responseTwoRemoteMagento2Jobs
            ->assertOk()
            ->assertJsonCount(2, 'jobs');

        // Assert can search one magento 2 job from big company

        $responseOneMagento2JobFromBigCompany = $this->getJson(
            route('api.jobs.search', ['company_size' => CompanySize::BIG, 'skill_id' => $magento2Skill->id])
        );

        $responseOneMagento2JobFromBigCompany
            ->assertOk()
            ->assertJsonCount(1, 'jobs');

        // Assert can search two magento 2 jobs that require junior developers

        $responseTwoMagento2JobRequireJunior = $this->getJson(
            route('api.jobs.search', ['experience_level' => ExperienceLevel::JUNIOR, 'skill_id' => $magento2Skill->id])
        );

        $responseTwoMagento2JobRequireJunior
            ->assertOk()
            ->assertJsonCount(2, 'jobs');
    }

    public function test_user_should_send_correct_values_to_search_jobs_by_company_size_contract_type_and_experience_type()
    {
        $responseCompanySize = $this->getJson(
            route('api.jobs.search', ['company_size' => 'wrong value'])
        );

        $responseCompanySize
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['company_size'])
            ->assertSee(CompanySize::OPTIONS);

        $responseContractType = $this->getJson(
            route('api.jobs.search', ['contract_type' => 'wrong value'])
        );

        $responseContractType
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['contract_type'])
            ->assertSee(ContractType::OPTIONS);


        $responseExperienceLevel = $this->getJson(
            route('api.jobs.search', ['experience_level' => 'wrong value'])
        );

        $responseExperienceLevel
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['experience_level'])
            ->assertSee(ExperienceLevel::OPTIONS);
    }

}
