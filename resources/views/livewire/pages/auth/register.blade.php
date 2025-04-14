<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\StrongPassword;
use App\Rules\RealEmail; // Add this import

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => '',
    'passwordStrength' => 0,
    'passwordLabel' => 'Too weak',
    // Add new state variables for email validation
    'validatingEmail' => false,
    'emailValid' => null,
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => [
        'required', 
        'string', 
        'lowercase', 
        'email', 
        'max:255', 
        'unique:'.User::class,
        new RealEmail, // Add the custom rule
    ],
    'password' => ['required', 'string', 'confirmed', new StrongPassword],
]);

// Add email validation method
$checkEmail = function() {
    if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->emailValid = false;
        return;
    }
    
    $this->validatingEmail = true;
    $this->emailValid = null;
    
    // Check domain MX records
    $domain = substr(strrchr($this->email, "@"), 1);
    
    if (!$domain || !checkdnsrr($domain, 'MX')) {
        $this->emailValid = false;
        $this->validatingEmail = false;
        return;
    }
    
    // Check for disposable email domains
    $disposableDomains = [
        'mailinator.com', 'yopmail.com', 'tempmail.com', 'temp-mail.org',
        'guerrillamail.com', '10minutemail.com', 'mailnesia.com'
    ];
    
    if (in_array($domain, $disposableDomains)) {
        $this->emailValid = false;
        $this->validatingEmail = false;
        return;
    }
    
    $this->emailValid = true;
    $this->validatingEmail = false;
};

// Password strength update method
$updatePasswordStrength = function() {
    if (empty($this->password)) {
        $this->passwordStrength = 0;
        $this->passwordLabel = 'Too weak';
        return;
    }
    
    $score = 0;
    
    // Add points for length
    if (strlen($this->password) >= 8) {
        $score += 25;
    }
    
    // Add points for numbers
    if (preg_match('/[0-9]/', $this->password)) {
        $score += 25;
    }
    
    // Add points for special characters
    if (preg_match('/[^A-Za-z0-9]/', $this->password)) {
        $score += 25;
    }
    
    // Add points for mixed case
    if (preg_match('/[a-z]/', $this->password) && preg_match('/[A-Z]/', $this->password)) {
        $score += 25;
    }
    
    $this->passwordStrength = $score;
    
    // Determine label based on score
    if ($score >= 100) {
        $this->passwordLabel = 'Very strong';
    } else if ($score >= 75) {
        $this->passwordLabel = 'Strong';
    } else if ($score >= 50) {
        $this->passwordLabel = 'Moderate';
    } else if ($score >= 25) {
        $this->passwordLabel = 'Weak';
    } else {
        $this->passwordLabel = 'Too weak';
    }
};

// Update register method to verify email first
$register = function () {
    // Double-check email validity
    $domain = substr(strrchr($this->email, "@"), 1);
    if (!$domain || !checkdnsrr($domain, 'MX')) {
        $this->addError('email', 'The email must have a valid domain with mail server.');
        return;
    }
    
    $validated = $this->validate();
    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));
    Auth::login($user);

    // Change this to redirect to verification notice
    $this->redirect(route('verification.notice', absolute: false), navigate: true);
};

?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                <x-text-input wire:model.blur="email" wire:blur="checkEmail" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                
                @if($validatingEmail)
                    <div class="absolute right-3 top-3 text-gray-400">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                @elseif($emailValid === true)
                    <div class="absolute right-3 top-3 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                @elseif($emailValid === false)
                    <div class="absolute right-3 top-3 text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
            </div>
            
            @if($emailValid === false && !$errors->has('email'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">This email address appears to be invalid. Please enter a real email address.</p>
            @endif
            
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input wire:model.live="password" wire:input="updatePasswordStrength" id="password" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 px-3 py-1.5 mt-1 text-gray-500 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            <!-- Password strength meter -->
            <div class="mt-2">
                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                    <div id="password-strength-meter" class="h-1.5 rounded-full transition-all duration-300" 
                        style="width: {{ $passwordStrength }}%;"
                        :class="{
                            'bg-red-500': $passwordStrength < 25,
                            'bg-yellow-500': $passwordStrength >= 25 && $passwordStrength < 50,
                            'bg-blue-500': $passwordStrength >= 50 && $passwordStrength < 75,
                            'bg-green-500': $passwordStrength >= 75
                        }"></div>
                </div>
                <small class="text-sm text-gray-600 dark:text-gray-400">Password strength: {{ $passwordLabel }}</small>
            </div>
            
            <!-- Password requirements -->
            <div class="mt-2 text-sm">
                <div class="{{ strlen($password) >= 8 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ strlen($password) >= 8 ? '✓' : '✗' }} At least 8 characters
                </div>
                <div class="{{ preg_match('/[0-9]/', $password) ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ preg_match('/[0-9]/', $password) ? '✓' : '✗' }} At least 1 number
                </div>
                <div class="{{ preg_match('/[^A-Za-z0-9]/', $password) ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ preg_match('/[^A-Za-z0-9]/', $password) ? '✓' : '✗' }} At least 1 special character
                </div>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('toggle-password');
    
    togglePasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Change the eye icon
        const eyeIcon = togglePasswordButton.querySelector('svg');
        if (type === 'text') {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            `;
        } else {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            `;
        }
    });
});
</script>