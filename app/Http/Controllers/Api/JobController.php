<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JobListRequest;
use App\Http\Resources\Api\JobsCollecion;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class JobController extends Controller
{

    protected const DEFAULT_JOBS_PER_PAGE = 10;

    /**
     * Display global listing of the jobs.
     *
     * @param JobListRequest $request
     * @return JobsCollecion<Job>
     */
    public function index(JobListRequest $request)
    {
        $filter = collect($request->validated());



        /* @var Builder|Job $list */

        $list = Job::with('skills');

        if($skillId = $filter->get('skill_id')) {
            $list->havingSkill($skillId);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
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
