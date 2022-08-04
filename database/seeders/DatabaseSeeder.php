<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Job::factory()->count(50)->create();

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

        $magento2Skill->jobs()->attach([
            $remoteBigCompanyJob->id,
            $remoteStartupJob->id
        ]);


    }
}
