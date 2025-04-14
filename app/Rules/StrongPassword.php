<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check minimum length
        if (strlen($value) < 8) {
            $fail('The password must be at least 8 characters.');
            return;
        }

        // Check for at least one number
        if (!preg_match('/[0-9]/', $value)) {
            $fail('The password must contain at least one number.');
            return;
        }

        // Check for at least one special character
        if (!preg_match('/[^A-Za-z0-9]/', $value)) {
            $fail('The password must contain at least one special character.');
            return;
        }
    }
}