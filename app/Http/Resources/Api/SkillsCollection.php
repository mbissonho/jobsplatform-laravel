<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SkillsCollection extends ResourceCollection
{
    public static $wrap = 'skills';

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = SkillResource::class;

}
