@props(['disabled' => false])
<?php
$uniqid = uniqid();
?>

<select id="{{ $uniqid }}" class="docs-{{ $uniqid }} border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
    <option value="">{{ __('Select a option') }}</option>
</select>
<input type="hidden" {!! $attributes->merge() !!}/>
<script>
    $('#{{ $uniqid }}').select2({
        ajax: {
            url: '{{ $attributes->get('ajax') }}',
            dataType: 'json'
        }
    });
    $('#{{ $uniqid }}').on('change', function (e) {
        var data = $('#{{ $uniqid }}').select2("val");
        $('#{{ $attributes['id'] }}').val(data);
        //@this.set('{{ $attributes['wire:model.defer'] }}', data);
    });
</script>
