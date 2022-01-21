<x-app-layout>
    <x-slot name="header">
        <x-layouts.header-title :text="__('Drivers Management')" />
    </x-slot>
    @can('create-driver')
        <div class="flex justify-end mb-6">
            <x-link :href="route('drivers.create')"><span>{{ trans('Add Driver') }}</span></x-link>
        </div>
    @endcan
    <livewire:driver.data-table />
</x-app-layout>
