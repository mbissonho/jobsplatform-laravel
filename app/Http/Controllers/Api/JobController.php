<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JobListRequest;
use App\Http\Resources\Api\JobsCollecion;
use App\Models\Job;
use Illuminate\Http\Request;

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

        $list = Job::with('skills');

        if($skillId = $filter->get('skill_id')) {
            $list->havingSkill($skillId);
        }
        return new JobsCollecion(
            $list
            ->paginate(!$request->has('per_page') ? self::DEFAULT_JOBS_PER_PAGE : null)->withQueryString()
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

}
