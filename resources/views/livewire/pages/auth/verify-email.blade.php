<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\state;

layout('layouts.guest');

// Add state for button loading status
state(['isResending' => false]);

$sendVerification = function () {
    if (Auth::user()->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        return;
    }

    $this->isResending = true;
    
    Auth::user()->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
    
    $this->isResending = false;
};

$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};

?>

<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <!-- Show user email for clarity -->
    <div class="mb-4 text-sm font-medium">
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('Email address:') }} <span class="font-bold">{{ Auth::user()->email }}</span>
        </p>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <x-primary-button 
            wire:click="sendVerification" 
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75 cursor-wait"
            class="relative">
            
            <span wire:loading.class="invisible" wire:target="sendVerification">
                {{ __('Resend Verification Email') }}
            </span>
            
            <span wire:loading wire:target="sendVerification" class="absolute inset-0 flex items-center justify-center">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        </x-primary-button>

        <button 
            wire:click="logout" 
            type="submit" 
            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
        </button>
    </div>
    
    <!-- Add helpful information -->
    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Having trouble?') }}</h3>
        <ul class="text-xs text-gray-600 dark:text-gray-400 list-disc list-inside space-y-1">
            <li>{{ __('Check your spam or junk folder') }}</li>
            <li>{{ __('Make sure your email address was entered correctly') }}</li>
            <li>{{ __('Allow emails from our domain in your email settings') }}</li>
        </ul>
    </div>
</div>