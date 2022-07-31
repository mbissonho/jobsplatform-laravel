<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\PaginableRequest;
use Illuminate\Foundation\Http\FormRequest;

class JobListRequest extends PaginableRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }
}
