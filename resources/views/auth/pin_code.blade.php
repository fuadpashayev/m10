<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('pin-code') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="pin_code" :value="__('Pin code')" />
            <x-text-input id="pin_code" class="block mt-1 w-full" type="text" name="pin_code" :value="old('pin_code')" required autofocus autocomplete="pin_code" />
            <x-input-error :messages="$errors->get('pin_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
