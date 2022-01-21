@props(['disabled' => false, 'hasError' => null ])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->class(
        [
            'rounded shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
            'bg-red-200' => $hasError
        ])
    !!}
>
