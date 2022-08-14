<?php

namespace App\Rules\Api;

use App\Models\CompanySize;
use Illuminate\Contracts\Validation\Rule;

class CompanySizeRule implements Rule
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
        return in_array($value, CompanySize::OPTIONS);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid company size. Expected values: ' . implode('|', CompanySize::OPTIONS);
    }
}
