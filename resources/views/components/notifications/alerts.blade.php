@if ($errors->any())

    {{-- Errors --}}
    <div
        x-cloak
        x-data="{ open: false }"
        x-show="open"
        x-init="setTimeout(() => { open = true }, 100); setTimeout(() => { open = false }, 50000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-red-500 text-white shadow-md rounded-lg mb-6">
        <div class="flex items-center justify-between p-3">
            <x-icons.error class="h-8 w-8" />
            <div class="flex-1 pl-3 leading-tight">
                <p class="font-bold">{{ __('Error') }}</p>
                <p>{{ __('Please check the errors listed below.') }}</p>
                {{-- <ul class="list-disc list-inside mt-2 pl-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-xs">{{ $error }}</li>
                    @endforeach
                </ul> --}}
            </div>
            {{-- Close Btn --}}
            <button @click="open = false" class="flex hover:bg-gray-900/10 p-1 rounded-md transition-colors duration-300">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>

@endif

{{-- @if (Session::has('success'))

    <div
        x-cloak
        x-data="{ open: false }"
        x-show="open"
        x-init="setTimeout(() => { open = true }, 100); setTimeout(() => { open = false }, 50000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-green-500 text-white shadow-md rounded-lg mb-6">
        <div class="flex items-center justify-between p-3">
            <x-icons.done class="h-8 w-8" />
            <div class="flex-1 pl-3 leading-tight">
                <p class="font-bold">{{ __('Success') }}</p>
                <p>{{ Session::get('success') }}</p>
            </div>
            <button @click="open = false" class="flex hover:bg-gray-900/10 p-1 rounded-md transition-colors duration-300">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>

@endif

@if (Session::has('warning'))

    <div
        x-cloak
        x-data="{ open: false }"
        x-show="open"
        x-init="setTimeout(() => { open = true }, 100); setTimeout(() => { open = false }, 50000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-green-500 text-white shadow-md rounded-lg mb-6">
        <div class="flex items-center justify-between p-3">
            <x-icons.warning class="h-8 w-8" />
            <div class="flex-1 pl-3 leading-tight">
                <p class="font-bold">{{ __('Warning') }}</p>
                <p>{{ Session::get('warning') }}</p>
            </div>
            <button @click="open = false" class="flex hover:bg-gray-900/10 p-1 rounded-md transition-colors duration-300">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>

@endif --}}