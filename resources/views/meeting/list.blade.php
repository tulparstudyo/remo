<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meetings') }}
            <a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition" style="float:right" href="{{ route('meeting.create') }}">&#10010;</a>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="items-center justify-end px-4 py-3 bg-gray-50 sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            {!! $dataTable !!}
        </div>
        <x-jet-section-border />
    </div>
    </div>
</x-app-layout>
