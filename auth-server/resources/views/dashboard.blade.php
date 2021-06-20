<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @forelse (auth()->user()->clients as $client)
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        <li><strong>ID:</strong> {{ $client->id }}</li>
                        <li><strong>Name:</strong> {{ $client->name }}</li>
                        <li><strong>Secret:</strong> {{ $client->secret }}</li>
                        <li><strong>Redirect:</strong> {{ $client->redirect }}</li>
                    </ul>
                </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200">
                        You don't have any clients!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
