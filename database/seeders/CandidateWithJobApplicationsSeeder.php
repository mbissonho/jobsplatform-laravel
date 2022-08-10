<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateWithJobApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        /* @var \Illuminate\Database\Eloquent\Collection<Job> $jobs */

        $jobs = Job::factory()->count(50)->create();

        $jobs->each(function ($job) use ($user){
            $job->applications()->attach(
                $user->id
            );
        });

    }
}
