<x-jet-form-section submit="updateEstateInformation">
    <x-slot name="title">
        {{ __('Estate Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your estate information and email address.') }}
        @if($this->state['embed']):
        {!! $this->state['embed'] !!}
        @endif;

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="embed" value="{{ __('embed') }}" />
            <x-jet-textarea id="embed" type="text" class="mt-1 block w-full" wire:model.defer="state.embed" autocomplete="embed" />
            <x-jet-input-error for="embed" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="mapurl" value="{{ __('mapurl') }}" />
            <x-jet-input id="mapurl" type="text" class="mt-1 block w-full" wire:model.defer="state.mapurl" autocomplete="mapurl" />
            <x-jet-input-error for="mapurl" class="mt-2" />
            <small class="get_coordinate_from_mapurl">Get Coordinate From Embed Code</small>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="latitude" value="{{ __('Latitude') }}" />
            <x-jet-input id="latitude" type="number"  step='0.0000001' class="mt-1 block w-full" wire:model.defer="state.latitude" />
            <x-jet-input-error for="latitude" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="longitude" value="{{ __('Longitude') }}" />
            <x-jet-input id="longitude" type="number"  step='0.0000001' class="mt-1 block w-full" wire:model.defer="state.longitude" />
            <x-jet-input-error for="longitude" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="form">
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden"
                   wire:model="photo"
                   x-ref="photo"
                   x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-jet-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="<?=url($this->state['image'])?>" alt="" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-jet-secondary-button>

            @if (1)
                <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </x-jet-secondary-button>
            @endif

            <x-jet-input-error for="photo" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="title" value="{{ __('Title') }}" />
            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="state.title" autocomplete="title" />
            <x-jet-input-error for="title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="contact" value="{{ __('contact') }}" />
            <x-jet-input id="contact" type="text" class="mt-1 block w-full" wire:model.defer="state.contact" autocomplete="contact" />
            <x-jet-input-error for="contact" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('phone') }}" />
            <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="phone" />
            <x-jet-input-error for="phone" class="mt-2" />
        </div>

        <div class="col-span-4 sm:col-span-2">
            <x-jet-label for="price" value="{{ __('Price') }}" />
            <x-jet-input id="price" type="number" class="mt-1 block w-full" wire:model.defer="state.price" />
            <x-jet-input-error for="price" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
            <x-jet-label for="country" value="{{ __('Country') }}" />
            <x-jet-select2 id="country" type="text"  class="mt-1 block w-full" wire:model.defer="state.country" />
            <x-jet-input-error for="country" class="mt-2" />
        </div>
        <div class="col-span-3 sm:col-span-3">
            <x-jet-label for="postcode" value="{{ __('Postcode') }}" />
            <x-jet-input id="postcode" type="text"  class="mt-1 block w-full" wire:model.defer="state.postcode" />
            <x-jet-input-error for="postcode" class="mt-2" />
        </div>
        <div class="col-span-3 sm:col-span-3">
            <x-jet-label for="region" value="{{ __('Region') }}" />
            <x-jet-input id="region" type="text"  class="mt-1 block w-full" wire:model.defer="state.region" />
            <x-jet-input-error for="region" class="mt-2" />
        </div>
        <div class="col-span-3 sm:col-span-3">
            <x-jet-label for="district" value="{{ __('District') }}" />
            <x-jet-input id="district" type="text"  class="mt-1 block w-full" wire:model.defer="state.district" />
            <x-jet-input-error for="district" class="mt-2" />
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

