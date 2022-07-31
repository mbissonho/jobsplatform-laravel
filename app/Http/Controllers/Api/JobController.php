<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JobListRequest;
use App\Http\Resources\Api\JobsCollecion;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class JobController extends Controller
{

    protected const DEFAULT_FILTER_LIMIT = 20;
    protected const DEFAULT_FILTER_OFFSET = 0;

    /**
     * Display global listing of the jobs.
     *
     * @param JobListRequest $request
     * @return JobsCollecion<Job>
     */
    public function index(JobListRequest $request)
    {
        $filter = collect($request->validated());

        $limit = $this->getLimit($filter);
        $offset = $this->getOffset($filter);

        $list = Job::list($limit, $offset);

        return new JobsCollecion($list->get());
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
     * Get limit from filter.
     *
     * @param \Illuminate\Support\Collection<string, string> $filter
     * @return int
     */
    private function getLimit(Collection $filter): int
    {
        return (int) ($filter['limit'] ?? static::DEFAULT_FILTER_LIMIT);
    }

    /**
     * Get offset from filter.
     *
     * @param \Illuminate\Support\Collection<string, string> $filter
     * @return int
     */
    private function getOffset(Collection $filter): int
    {
        return (int) ($filter['offset'] ?? static::DEFAULT_FILTER_OFFSET);
    }

}
