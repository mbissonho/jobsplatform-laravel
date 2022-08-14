<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Tests\TestCase;

class CandidateTest extends TestCase
{
    public function test_authenticated_candidate_can_paginate_your_applications()
    {
        $this->seed();

        $user = User::first();

        $response = $this->actingAs($user)
            ->getJson(
                route('api.candidates.applications.get-my-applications'),
            );

        $response
            ->assertOk()
            ->assertJsonStructure(
            [
                'applications' => [
                    [
                        "id",
                        "user_id",
                        "job_id",
                        "created_at",
                        "updated_at",
                        "viewed_by_company",
                        "job" => [
                            "id",
                            "title",
                            "created_at",
                            "updated_at",
                            "remote",
                            "accept_candidates_from_outside",
                            "company_size",
                            "contract_type",
                            "experience_level",
                            "description"
                        ]
                    ]
                ]
            ]
            );

        $this->assertSeePaginationJsonProperties($response);
    }

    public function test_unauthenticated_candidate_cannot_paginate_your_applications()
    {

        $this->getJson(
                route('api.candidates.applications.get-my-applications'),
            )
        ->assertUnauthorized()
        ->assertSee('Unauthenticated');
    }

}
