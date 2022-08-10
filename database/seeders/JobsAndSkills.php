<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class JobsAndSkills extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::factory()->count(50)->create();

        //Create two Magento 2 remote jobs
        //One from big company and another from startup
        $magento2Skill = Skill::factory()->createOne([
            'name' => 'Magento 2'
        ]);

        $remoteBigCompanyJob = Job::factory()
            ->remote()
            ->fromBigCompany()
            ->requireSenior()
            ->createOne();

        $remoteStartupJob = Job::factory()
            ->remote()
            ->fromStartup()
            ->requireJunior()
            ->createOne();

        //Create one Magento 2 on-site job

        $onSiteStartupJob = Job::factory()
            ->remote(false)
            ->fromStartup()
            ->requireJunior()
            ->createOne();

        $magento2Skill->jobs()->attach([
            $remoteBigCompanyJob->id,
            $remoteStartupJob->id,
            $onSiteStartupJob->id
        ]);
    }
}
