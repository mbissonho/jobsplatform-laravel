<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchJobsRequest;
use App\Http\Resources\Api\JobsCollecion;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class JobController extends Controller
{

    protected const DEFAULT_JOBS_PER_PAGE = 10;

    /**
     * Search jobs.
     *
     * @param SearchJobsRequest $request
     * @return JobsCollecion<Job>
     */
    public function index(SearchJobsRequest $request)
    {
        $filter = collect($request->validated());

        /* @var Builder|Job $list */

        $list = Job::with('skills');

        if($skillId = $filter->get('skill_id')) {
            $list->requireSkill($skillId);
        }

        if($skillId = $filter->get('company_size')) {
            $list->ofCompanySize($skillId);
        }

        if($skillId = $filter->get('contract_type')) {
            $list->withContractType($skillId);
        }

        if($skillId = $filter->get('experience_level')) {
            $list->requireExperienceLevel($skillId);
        }

        if($isRemote = $filter->get('remote')) {
            $list->isRemote($isRemote);
        }

        return new JobsCollecion(
            $list
            ->paginate($this->getPerPage($filter))->withQueryString()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }


    /**
     * Apply candidate to a given job.
     *
     * @param  \App\Models\Job  $job
     */
    public function applyCandidateTo(Job $job)
    {
        Application::create([
            'user_id' => auth()->user()->id,
            'job_id' => $job->id
        ]);
    }


    /**
     * Get per page param from filtered request data
     *
     * @param \Illuminate\Support\Collection<string, string> $filter
     * @return int|null
     */
    private function getPerPage(Collection $filter): int|null
    {
        return !$filter->has('per_page') ? self::DEFAULT_JOBS_PER_PAGE : null;
    }

}
