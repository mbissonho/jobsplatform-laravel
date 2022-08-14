<?php

namespace App\Rules\Api;

use App\Models\CompanySize;
use App\Models\ExperienceLevel;
use Illuminate\Contracts\Validation\Rule;

class ExperienceLevelRule implements Rule
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
        return in_array($value, ExperienceLevel::OPTIONS);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid experience level. Expected values: ' . implode('|', ExperienceLevel::OPTIONS);
    }
}
