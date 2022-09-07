<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('meeting.form', ['id'=>$id])
            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
<script>
    function available_times(user_id){
        $('#docs-time-container').css('opacity','0.2');
        $.ajax( "{{ route('available_times') }}?id="+user_id )
            .done(function(html) {
                $('#docs-time-container').html(html);
            })
            .fail(function() {

            })
            .always(function() {
                $('#docs-time-container').css('opacity','1');
            });
    }
    $('body').on('click', '.available-times tr', function(){
        $('#time').val($(this).data('hour'));
    });

</script>
