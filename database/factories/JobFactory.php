<?php

namespace Database\Factories;

use App\Models\CompanySize;
use App\Models\ContractType;
use App\Models\ExperienceLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $booleanOptions = [true, false];

        return [
            'title' => $this->faker->unique()->sentence(4),
            'remote' => $this->faker->randomElement($booleanOptions),
            'accept_candidates_from_outside' => $this->faker->randomElement($booleanOptions),
            'company_size' => $this->faker->randomElement(CompanySize::OPTIONS),
            'contract_type' => $this->faker->randomElement(ContractType::OPTIONS),
            'experience_level' => $this->faker->randomElement(ExperienceLevel::OPTIONS),
            'description' => $this->faker->text()
        ];
    }

    /**
     * Indicate that the job is remote or on-site.
     *
     * @return JobFactory
     */
    public function remote($is = true): self
    {
        return $this->state(function () use ($is){
            return [
                'remote' => $is,
                'accept_candidates_from_outside' => $is,
            ];
        });
    }

    /**
     * Indicate that the job is from big company.
     *
     * @return JobFactory
     */
    public function fromBigCompany(): self
    {
        return $this->state(function (){
            return [
                'company_size' => CompanySize::BIG
            ];
        });
    }

    /**
     * Indicate that the job is from big company.
     *
     * @return JobFactory
     */
    public function fromStartup(): self
    {
        return $this->state(function (){
            return [
                'company_size' => CompanySize::STARTUP
            ];
        });
    }

    /**
     * Indicate that the job require senior developer.
     *
     * @return JobFactory
     */
    public function requireSenior(): self
    {
        return $this->state(function (){
            return [
                'experience_level' => ExperienceLevel::SENIOR
            ];
        });
    }

    /**
     * Indicate that the job require junior developer.
     *
     * @return JobFactory
     */
    public function requireJunior(): self
    {
        return $this->state(function (){
            return [
                'experience_level' => ExperienceLevel::JUNIOR
            ];
        });
    }


}
