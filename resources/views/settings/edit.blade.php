<x-app-layout>

    <x-slot name="header">
        <x-layouts.header-title :text="__('Settings Management')" />
    </x-slot>

    <div class="flex justify-end mb-6">
        <x-link :href="route('dashboard')"><span>{{ trans('Back to Dashboard') }}</span></x-link>
    </div>

    <x-card>
        <x-card.header :text="trans('Editing Settings')" />

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf

            <x-forms.group>
                <x-label for="name" :value="__('Name')" />
                <x-input type="text" name="name" id="name" class="w-full max-w-3xl" :value="$setting->name" :has-error="$errors->has('name')" />
                <x-forms.error name="name" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="rnc" :value="__('RNC')" />
                <x-input type="text" name="rnc" id="rnc" class="w-full max-w-3xl" :value="$setting->rnc" :has-error="$errors->has('rnc')" />
                <x-forms.error name="rnc" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="address" :value="__('Address')" />
                <x-input type="text" name="address" id="address" class="w-full max-w-3xl" :value="$setting->address" :has-error="$errors->has('address')" />
                <x-forms.error name="addres" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="phone" :value="__('Phone')" />
                <x-input type="text" name="phone" id="phone" class="w-full max-w-3xl" :value="$setting->phone" :has-error="$errors->has('phone')" />
                <x-forms.error name="phone" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="mobile" :value="__('Mobile')" />
                <x-input type="text" name="mobile" id="mobile" class="w-full max-w-3xl" :value="$setting->mobile" :has-error="$errors->has('mobile')" />
                <x-forms.error name="mobile" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="email" :value="__('Email')" />
                <x-input type="text" name="email" id="email" class="w-full max-w-3xl" :value="$setting->email" :has-error="$errors->has('email')" />
                <x-forms.error name="email" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="site" :value="__('Site')" />
                <x-input type="text" name="site" id="site" class="w-full max-w-3xl" :value="$setting->site" :has-error="$errors->has('site')" />
                <x-forms.error name="site" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="facebook" :value="__('Facebook')" />
                <x-input type="text" name="facebook" id="facebook" class="w-full max-w-3xl" :value="$setting->facebook" :has-error="$errors->has('facebook')" />
                <x-forms.error name="facebook" />
            </x-forms.group>

            <x-forms.group>
                <x-label for="instagram" :value="__('Instagram')" />
                <x-input type="text" name="instagram" id="instagram" class="w-full max-w-3xl" :value="$setting->instagram" :has-error="$errors->has('instagram')" />
                <x-forms.error name="instagram" />
            </x-forms.group>

            <div class="flex justify-end mt-10">
                <x-button type="submit">
                    {{ trans('Update') }}
                </x-button>
            </div>

        </form>

    </x-card>

</x-app-layout>
