<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('estate.form', ['id'=>$id])
            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
<script>
    $('body').on('click','.get_coordinate_from_mapurl', function(){
        var div = document.createElement('div');
        const src = $('#mapurl').val();
        console.log(src);
        const regex = /@([0-9\.]+),([0-9\.]+),([0-9z]+)/;
        let m;
        if ((m = regex.exec(src)) !== null) {
            // The result can be accessed through the `m`-variable.
            $('#latitude').val(m[1]);
            $('#longitude').val(m[2]);
        }

    });
</script>
