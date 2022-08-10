<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApplicationsCollection extends ResourceCollection
{

    public static $wrap = 'applications';

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ApplicationResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
