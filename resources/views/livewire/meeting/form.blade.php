<x-jet-form-section submit="updateMeetingInformation">
    <x-slot name="title">
        {{ __('Create a Meeting') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your meeting\'s information') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="estate_id" value="{{ __('Select a Estate') }}" />
            <x-jet-select2 id="estate_id" class="mt-1 block w-full" wire:model.defer="state.estate_id" autocomplete="estate_id"  ajax="{{ route('estate.select2') }}"/>
            <x-jet-input-error for="estate_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="customer_id" value="{{ __('Select a Costumer') }}" />
            <x-jet-select2 id="customer_id" class="mt-1 block w-full" wire:model.defer="state.customer_id" autocomplete="customer_id" ajax="{{ route('customer.select2') }}"/>
            <x-jet-input-error for="customer_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="user_id" value="{{ __('Select a Member') }}" />
            <x-jet-select2 id="user_id" class="mt-1 block w-full" wire:model.defer="state.user_id" autocomplete="user_id"  ajax="{{ route('user.select2') }}"/>
            <x-jet-input-error for="user_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="start_at" value="{{ __('Select a Date') }}" />
            <x-jet-datepicker id="start_at" type="text" class="mt-1 block w-full" wire:model.defer="state.start_at" autocomplete="start_at" />
            <x-jet-input-error for="start_at" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
            <x-jet-label for="time" value="{{ __('Time') }}" />
            <x-jet-input id="time" type="text" class="mt-1 block w-full" wire:model.defer="state.time" autocomplete="time" />
            <x-jet-input-error for="time" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
            <x-jet-label for="duration" value="{{ __('Duration') }}" />
            <x-jet-input id="duration" type="text" class="mt-1 block w-full" wire:model.defer="state.duration" autocomplete="time" />
            <x-jet-input-error for="duration" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-jet-textarea id="description" class="mt-1 block w-full" wire:model.defer="state.description" autocomplete="description" />
            <x-jet-input-error for="description" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="status" value="{{ __('status') }}" />
            <x-jet-checkbox id="status" type="text"  wire:model.defer="state.status" />
            <x-jet-input-error for="status" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        <input type="hidden" name="id" value="{{ $state['id'] }}">
        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
