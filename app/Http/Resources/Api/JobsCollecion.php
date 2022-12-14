<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class JobsCollecion extends ResourceCollection
{
    public static $wrap = 'jobs';

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = JobResource::class;

}
