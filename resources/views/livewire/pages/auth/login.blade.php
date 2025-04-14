<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    try {
        $this->form->authenticate();
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    } catch (\Illuminate\Validation\ValidationException $e) {
        $this->addError('form.general', __('Invalid credentials. Please try again.'));
    }
};

?>

<div class="max-w-md mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- General Authentication Error -->
    @if ($errors->has('form.general'))
        <div class="mb-4 text-sm text-red-600 dark:text-red-400">
            {{ $errors->first('form.general') }}
        </div>
    @endif

    <form wire:submit="login" class="space-y-4">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
            <label for="remember" class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    
    <!-- Added navigation options -->
    <div class="mt-6 flex flex-col space-y-2 pt-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" wire:navigate class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                {{ __('← Back to Homepage') }}
            </a>
            
            <a href="{{ route('register') }}" wire:navigate class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                {{ __('Create an account →') }}
            </a>
        </div>
    </div>
</div>