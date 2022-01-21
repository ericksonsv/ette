<x-app-layout>

    <x-slot name="header">
        <x-layouts.header-title :text="__('Users Management')" />
    </x-slot>

    <div class="flex justify-end mb-6">
        <x-link :href="route('users.index')"><span>{{ trans('Back to List') }}</span></x-link>
    </div>

    <x-card>
        <x-card.header :text="trans('Add New User')" />

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <x-forms.group>
                <x-label for="name" :value="__('Name')" />
                <x-input type="text" name="name" id="name" class="w-full max-w-xl" :value="old('name')" :has-error="$errors->has('name')" />
                <x-forms.error name="name" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="email" :value="__('Email')" />
                <x-input type="email" name="email" id="email" class="w-full max-w-xl" :value="old('email')" :has-error="$errors->has('email')" />
                <x-forms.error name="email" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="type" :value="__('Type')" />
                <x-select name="type" id="type" class="w-full max-w-xl" :has-error="$errors->has('type')">
                    <option value="0">{{ trans('User') }}</option>
                    <option value="1">{{ trans('Admin') }}</option>
                </x-select>
                <x-forms.error name="type" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="password" :value="__('Password')" />
                <x-input type="password" name="password" id="password" class="w-full max-w-xl" :has-error="$errors->has('password')" />
                <x-forms.error name="password" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="password_confirmation" :value="__('Password Confirmation')" />
                <x-input type="password" name="password_confirmation" id="password_confirmation" class="w-full max-w-xl" :has-error="$errors->has('password_confirmation')" />
                <x-forms.error name="password" />
            </x-forms.group>

            <div class="flex justify-end mt-10">
                <x-button type="submit">
                    {{ trans('Create') }}
                </x-button>
            </div>


        </form>

    </x-card>

</x-app-layout>
