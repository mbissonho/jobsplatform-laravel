<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public static $wrap = 'job';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'remote' => boolval($this->resource->remote),
            'accept_candidates_from_outside' => boolval($this->resource->accept_candidates_from_outside),
            'company_size' => $this->resource->company_size,
            'contract_type' => $this->resource->contract_type,
            'experience_level' => $this->resource->experience_level,
            'required_skills' => new SkillsCollection($this->resource->skills)
        ];
    }
}
