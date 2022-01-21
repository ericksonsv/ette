<x-app-layout>

    <x-slot name="header">
        <x-layouts.header-title :text="__('Orders Management')" />
    </x-slot>

    <div class="flex justify-end mb-6">
        <x-link :href="route('orders.index')"><span>{{ trans('Back to List') }}</span></x-link>
    </div>

    <livewire:order.create />

</x-app-layout>
