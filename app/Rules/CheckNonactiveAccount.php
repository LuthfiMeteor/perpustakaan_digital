<?php

namespace App\Rules;

use App\Models\DeactiveAccountModel;
use Illuminate\Contracts\Validation\Rule;

class CheckNonactiveAccount implements Rule
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
        // Implement the logic to check if the value is not present in log_account_nonactive table
        return !DeactiveAccountModel::where('email', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // Define the error message returned when validation fails
        return 'Account Has Deactive. Please Contact Support Team.';
    }
}
