<x-app-layout>
    <x-slot name="header">
        <x-layouts.header-title :text="__('My Profile')" />
    </x-slot>

    <div class="flex justify-end mb-6">
        <x-button linkable href="{{ route('dashboard') }}"><span>{{ trans('Back to dashboard') }}</span></x-button>
    </div>

    <x-card>
        <x-card.header :text="__('My Profile Information')" />
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <x-forms.group>
                <x-label for="name" :value="__('Name')" />
                <x-input type="text" name="name" id="name" class="w-full max-w-xl" :value="auth()->user()->name" :has-error="$errors->has('name')" />
                <x-forms.error name="name" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="email" :value="__('Email')" />
                <x-input type="email" name="email" id="email" class="w-full max-w-xl" :value="auth()->user()->email" :has-error="$errors->has('email')" />
                <x-forms.error name="email" />
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
                    {{ trans('Update') }}
                </x-button>
            </div>

        </form>
    </x-card>

    @if (count(auth()->user()->services))
        <x-card class="mt-10">
            <x-card.header :text="trans('My Created Services')" />
            <livewire:user.services-data-table user="{{ auth()->user()->id }}" />
        </x-card>
    @endif

</x-app-layout>
