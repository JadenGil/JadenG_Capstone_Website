<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RealEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Basic format validation
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $fail('The :attribute must be a valid email address.');
            return;
        }

        // Check domain has valid MX records
        $domain = substr(strrchr($value, "@"), 1);
        if (!$domain || !checkdnsrr($domain, 'MX')) {
            $fail('The :attribute must have a valid domain with mail server.');
            return;
        }

        // Block disposable email domains (optional)
        $disposableDomains = [
            'mailinator.com', 'yopmail.com', 'tempmail.com', 'temp-mail.org',
            'guerrillamail.com', '10minutemail.com', 'mailnesia.com',
        ];

        if (in_array($domain, $disposableDomains)) {
            $fail('The :attribute cannot use a disposable email service.');
            return;
        }
    }
}