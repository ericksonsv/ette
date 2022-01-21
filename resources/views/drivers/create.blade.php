<x-app-layout>

    <x-slot name="header">
        <x-layouts.header-title :text="__('Drivers Management')" />
    </x-slot>

    <div class="flex justify-end mb-6">
        <x-link :href="route('drivers.index')"><span>{{ trans('Back to List') }}</span></x-link>
    </div>

    <x-card>
        <x-card.header :text="trans('Add New Driver')" />

        <form action="{{ route('drivers.store') }}" method="POST">
            @csrf
            <x-forms.group>
                <x-label for="name" :value="__('Name')" />
                <x-input type="text" name="name" id="name" class="w-full max-w-xl" :value="old('name')" :has-error="$errors->has('name')" />
                <x-forms.error name="name" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="phone" :value="__('Phone')" />
                <x-input type="text" name="phone" id="phone" class="w-full max-w-xl" :value="old('phone')" :has-error="$errors->has('phone')" />
                <x-forms.error name="phone" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="active" :value="__('Status')" />
                <x-select name="active" id="active" class="w-full max-w-xl" :has-error="$errors->has('active')">
                    <option value="1">{{ trans('Active') }}</option>
                    <option value="0">{{ trans('Inactive') }}</option>
                </x-select>
                <x-forms.error name="active" />
            </x-forms.group>

            <div class="flex justify-end mt-10">
                <x-button type="submit">
                    {{ trans('Create') }}
                </x-button>
            </div>
        </form>

    </x-card>

</x-app-layout>
