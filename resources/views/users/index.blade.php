<x-app-layout>
    <x-slot name="header">
        <x-layouts.header-title :text="__('Users Management')" />
    </x-slot>
    <div class="flex justify-end mb-6">
        <x-link :href="route('users.create')"><span>{{ trans('Add User') }}</span></x-link>
    </div>
    <livewire:user.data-table />
</x-app-layout>
