@props(['options' => [], 'hasError' => null, 'disabled' => false, 'id'])

@php
    $options = array_merge([
                    'noCalendar' => true,
                    'enableTime' => true,
                    'dateFormat' =>  'H:i',
                    'time_24hr' =>  true,
                    'altInput' => false
                    ], $options);
@endphp

<div wire:ignore>
    <input
       x-data="{
           init() {
               flatpickr(this.$refs.input, {{json_encode((object)$options)}});
           }
        }"
        x-ref="input"
        type="text"
        {{ $attributes->class(
            [
                'rounded shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer',
                'bg-red-200' => $hasError
            ]
        ) }}
    />
    <button
        @click="
            console.log('Clearing');
            flatpickr('#{{$id}}', {}).clear();
        "
        id="{{$id}}-clear"
        type="button">Clear</button>
    {{-- <script>
        var clearBtn = document.getElementById('{{$id}}-clear');
        clearBtn.addEventListener('click', () => {
            flatpickr(this.$refs.input, {{json_encode((object)$options)}}).clear();
        });
    </script> --}}
</div>