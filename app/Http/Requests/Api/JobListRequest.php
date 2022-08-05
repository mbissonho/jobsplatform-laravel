<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\CompanySizeRule;
use App\Rules\Api\ContractTypeRule;
use App\Rules\Api\ExperienceLevelRule;

class JobListRequest extends AbstractApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'skill_id' => 'sometimes|integer|min:1',
            'remote' => 'sometimes|boolean',
            'company_size' => ['sometimes', new CompanySizeRule()],
            'contract_type' => ['sometimes', new ContractTypeRule()],
            'experience_level' => ['sometimes', new ExperienceLevelRule()],
        ];
    }

}
