<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Pin code') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('update pin code bla bla bla') }}
        </p>
    </header>

    <form method="post" action="{{ route('pin-code.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mt-4">
            <x-input-label for="pin_code" :value="__('Pin code')" />
            <x-text-input id="pin_code" class="block mt-1 w-full" type="text" name="pin_code" :value="old('pin_code')" required autofocus autocomplete="pin_code" />
            <x-input-error :messages="$errors->get('pin_code')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'pin-code-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
