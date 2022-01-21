@props(['hasError' => null ])

<textarea
    {!! $attributes->class(
        [
            'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
            'bg-red-200' => $hasError
        ])
    !!}>
    {{ $slot }}
</textarea>