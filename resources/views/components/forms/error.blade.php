@props(['name'])

@error($name)
    <p {{ $attributes->class(['text-red-500 text-xs font-bold mt-1']) }}>{{ $message}}</p>
@enderror