<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('transactions.generate') }}" method="post">
                @csrf
                @dump($errors->all())
                <input type="text" name="payer_id" id="payer_id" value="{{ \App\Models\User::query()->inRandomOrder()->value('id') }}" placeholder="payer_id">
                <input type="text" name="amount" id="amount" placeholder="amount" value="{{ rand(10,300) }}">
                <input type="text" name="type" id="amount" placeholder="payment" value="{{ 'payment' }}">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>
