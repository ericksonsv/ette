@can('assign-driver', $row)

    <select
        wire:change.prevent="changeDriver($event.target.value, {{ $row }})"
        name="driver"
        id="driver"
        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
        @foreach ($drivers as $id => $name)
            <option value="{{ $id }}" {{ $row->driver_id == $id ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>

@else
    {{ $row->driver->name }}
@endcan
