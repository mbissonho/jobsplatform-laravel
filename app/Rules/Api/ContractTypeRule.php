<?php

namespace App\Rules\Api;

use App\Models\ContractType;
use Illuminate\Contracts\Validation\Rule;

class ContractTypeRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, ContractType::OPTIONS);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid contract type. Expected values: ' . implode('|', ContractType::OPTIONS);
    }
}
