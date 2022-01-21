<div x-data="{ preview: false, edit: false }" @keydown.window.escape="preview = false" class="flex items-center justify-end space-x-1">

    <x-tables.show-button @click.prevent="preview = ! preview" href="" :text="__('Show')" />
    @can('update-service', $row)
        <x-tables.edit-button href="{{ route('services.edit', $row) }}" :text="__('Edit')" />
    @endcan
    @can('delete-service', $row)
        <x-tables.delete-button wire:click.stop.prevent="removeRow({{ $row->id }})" href="#" :text="__('Delete')" onclick="confirm('¿Deseas eliminar esta orden?') || event.stopImmediatePropagation()" />
    @endcan
    <x-tables.print-button href="{{ route('print.service', $row->id) }}" target="__new" :text="__('Print Service')" />
    <x-tables.invoice-print href="{{ route('print.invoice', $row->id) }}" target="__new" :text="__('Print Invoice')" />
    {{-- Preview Modal --}}
    <div x-cloak x-show="preview" class="fixed flex items-center justify-center z-10 inset-0 overflow-y-auto p-6">

        <div
            x-cloak
            x-show="preview"
            x-transition:enter="ease-out duration-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-description="Background overlay, show/hide based on modal state."
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="preview = false"
            aria-hidden="true">
        </div>

        <x-card
            x-cloak
            x-show="preview"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative flex flex-col justify-between w-full max-w-5xl overflow-y-auto" style="height: 90%">

            <h1 class="text-xl font-bold">{{ trans('Service') }}: #{{ $row->id }}</h1>

            <div class="space-y-2 my-10 flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Created By') }}</p>
                    <p>{{ $row->user->name }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Company') }}</p>
                    <p>{{ $row->order->company }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Client') }}</p>
                    <p>{{ $row->order->client_name }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Date') }}</p>
                    <p>{{ $row->date->toFormattedDateString() }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Time') }}</p>
                    <p>{{ displayTime($row->time) }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Flight') }}</p>
                    <p>{{ $row->flight }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Flight Time') }}</p>
                    <p>{{ displayTime($row->flight_time) }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Passengers') }}</p>
                    <p>{{ $row->passengers }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Pickup') }}</p>
                    <p>{{ $row->pickup }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Dropoff') }}</p>
                    <p>{{ $row->dropoff }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Amount') }}</p>
                    <p>{{ $row->currency }} {{ $row->amount }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Type') }}</p>
                    <p>{{ $row->type }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Status') }}</p>
                    <p>{{ $row->status }}</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Driver') }}</p>
                    @if ($row->driver_id == 1)
                        <p>{{ $row->driver->name }}</p>
                    @else
                        <a class="underline text-blue-500" href="{{ route('drivers.edit', $row->driver->id) }}">
                            <p>{{ $row->driver->name }}</p>
                        </a>
                    @endif
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-1">
                    <p class="md:bg-gray-100 md:pl-2 md:w-52 text-sm text-gray-500 font-bold">{{ __('Note') }}</p>
                    <p>{{ $row->note }}</p>
                </div>
            </div>

            <div class="flex justify-center sm:justify-end space-x-2">
                <x-button
                    wire:click.stop.prevent="removeRow({{ $row->id }})"
                    onclick="confirm('¿Deseas eliminar esta orden?') || event.stopImmediatePropagation()"
                    class="bg-red-500 hover:bg-red-700">
                    <span>{{ trans('Remove') }}</span>
                </x-button>
                <x-button @click="preview = false">
                    <span>{{ trans('Close') }}</span>
                </x-button>
                <x-link href="{{ route('print.service', $row->id) }}" target="__new" class="bg-indigo-500 hover:bg-indigo-700">
                    <span>{{ trans('Print') }}</span>
                </x-link>
            </div>

        </x-card>

    </div>

</div>
