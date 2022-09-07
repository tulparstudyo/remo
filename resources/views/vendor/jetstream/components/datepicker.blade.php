@props(['disabled' => false])
<?php
$uniqid = uniqid();
?>

<div class="docs-datepicker">
    <div class="input-group">
        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'docs-date border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
    </div>
    <div class="docs-datepicker-container"></div>
</div>

<script>
    $(function () {
        'use strict';
        var $date = $('.docs-date');
        var $container = $('.docs-datepicker-container');
        var options = {
            show: function (e) {
                console.log(e.type, e.namespace);
            },
            hide: function (e) {
                console.log(e.type, e.namespace);
            },
            pick: function (e) {
                console.log(e.type, e.namespace, e.view);
            },
            inline: true,
            container: $container
        };
        $date.on({
            'show.datepicker': function (e) {
                //console.log(e.type, e.namespace);
            },
            'hide.datepicker': function (e) {
                //console.log(e.type, e.namespace);
            },
            'pick.datepicker': function (e) {
                available_times(1);
                //console.log(e.type, e.namespace, e.view);
            }
        });
        $date.datepicker(options);
        $container.append('<div id="docs-time-container">')
    });
</script>
