<div>
    <x-card>
        <x-card.header :text="trans('Add Order')" />

        <form wire:submit.prevent="store">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-2">
                <div>
                    <x-label for="company" :value="__('Company')" />
                    <x-input wire:model.lazy="company" type="text" name="company" id="company" class="w-full max-w-xl" :value="old('company')" :has-error="$errors->has('company')" />
                    <x-forms.error name="company" />
                </div>
                <div>
                    <x-label for="client_name" :value="__('Client Name')" />
                    <x-input wire:model.lazy="client_name" type="text" name="client_name" id="client_name" class="w-full max-w-xl" :value="old('client_name')" :has-error="$errors->has('client_name')" />
                    <x-forms.error name="client_name" />
                </div>
                <div>
                    <x-label for="client_email" :value="__('Client Email')" />
                    <x-input wire:model.lazy="client_email" type="email" name="client_email" id="client_email" class="w-full max-w-xl" :value="old('client_email')" :has-error="$errors->has('client_email')" />
                    <x-forms.error name="client_email" />
                </div>
                <div>
                    <x-label for="client_phone" :value="__('Client Phone')" />
                    <x-input wire:model.lazy="client_phone" type="text" name="client_phone" id="client_phone" class="w-full max-w-xl" :value="old('client_phone')" :has-error="$errors->has('client_phone')" />
                    <x-forms.error name="client_phone" />
                </div>
            </div>

            <section class="mt-10">
                <h3 class="font-bold text-lg mb-6">{{ trans('Assign Services') }}</h3>

                <div class="space-y-4 mb-6">
                    @forelse ($orderServices as $index => $services)
                        <section class="bg-gray-100 p-4 rounded-lg">

                            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 sm:gap-1">
                                {{-- Date --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][date]" :value="__('Date')" />
                                    <x-input
                                        wire:model.lazy="orderServices.{{$index}}.date"
                                        type="date"
                                        {{-- min="{{ now()->toDateString() }}" --}}
                                        name="orderServices[{{ $index }}][date]"
                                        id="orderServices[{{ $index }}][date]" class="date w-full text-sm"
                                        :value="old('date')" :has-error="$errors->has('orderServices.'.$index.'.date')"
                                    />
                                    <x-forms.error name="orderServices.{{ $index }}.date" />
                                </div>
                                {{-- Time --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][time]" :value="__('Pickup Time')" />
                                    <x-time-picker
                                        wire:model.lazy="orderServices.{{$index}}.time"
                                        name="orderServices[{{ $index }}][time]"
                                        id="orderServices[{{ $index }}][time]"
                                        class="w-full text-sm" />
                                    <x-forms.error name="orderServices.{{ $index }}.time" />
                                </div>
                                {{-- Flight --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][flight]" :value="__('Flight')" />
                                    <x-input
                                        wire:model.lazy="orderServices.{{$index}}.flight"
                                        type="text"
                                        name="orderServices[{{ $index }}][flight]"
                                        id="orderServices[{{ $index }}][flight]" class="w-full text-sm"
                                        :has-error="$errors->has('orderServices.'.$index.'.flight')" />
                                    <x-forms.error name="orderServices.{{ $index }}.flight" />
                                </div>
                                {{-- Flight Time --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][flight_time]" :value="__('Flight Time')" />
                                    <x-time-picker
                                        wire:model.lazy="orderServices.{{$index}}.flight_time"
                                        name="orderServices[{{ $index }}][flight_time]"
                                        id="orderServices[{{ $index }}][flight_time]"
                                        class="w-full text-sm" />
                                    <x-forms.error name="orderServices.{{ $index }}.flight_time" />
                                </div>
                                {{-- Passengers --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][passengers]" :value="__('Passengers')" />
                                    <x-input
                                        wire:model.lazy="orderServices.{{$index}}.passengers"
                                        type="number"
                                        min="1"
                                        name="orderServices[{{ $index }}][passengers]"
                                        id="orderServices[{{ $index }}][passengers]" class="w-full text-sm"
                                        :value="old('orderServices[{{ $index }}][passengers]')"
                                        :has-error="$errors->has('orderServices.'.$index.'.passengers')" />
                                    <x-forms.error name="orderServices.{{ $index }}.passengers" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 sm:gap-1 mt-4">
                                {{-- Currency --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][currency]" :value="__('Currency')" />
                                    <x-select
                                        wire:model.lazy="orderServices.{{$index}}.currency"
                                        name="orderServices[{{ $index }}][currency]"
                                        id="orderServices[{{ $index }}][currency]" class="w-full text-sm"
                                        :has-error="$errors->has('orderServices.'.$index.'.currency')">
                                        <option value="">{{ trans('Select currency...') }}</option>
                                        <option value="DOP">DOP</option>
                                        <option value="USD">USD</option>
                                    </x-select>
                                    <x-forms.error name="orderServices.{{ $index }}.currency" />
                                </div>
                                {{-- Amount --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][amount]" :value="__('Amount')" />
                                    <x-input
                                        wire:model.lazy="orderServices.{{$index}}.amount"
                                        type="number" min="0" step="0.00"
                                        name="orderServices[{{ $index }}][amount]"
                                        id="orderServices[{{ $index }}][amount]" class="w-full text-sm"
                                        :value="old('orderServices[{{ $index }}][amount]')"
                                        :has-error="$errors->has('orderServices.'.$index.'.amount')" />
                                    <x-forms.error name="orderServices.{{ $index }}.amount" />
                                </div>
                                {{-- Type --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][type]" :value="__('Type')" />
                                    <x-select
                                        wire:model.lazy="orderServices.{{$index}}.type"
                                        name="orderServices[{{ $index }}][type]"
                                        id="orderServices[{{ $index }}][type]" class="w-full text-sm"
                                        :has-error="$errors->has('orderServices.'.$index.'.type')">
                                        <option value="estandar">{{ trans('Standard') }}</option>
                                        <option value="corporativo">{{ trans('Corporate') }}</option>
                                    </x-select>
                                    <x-forms.error name="orderServices.{{ $index }}.type" />
                                </div>
                                {{-- Status --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][status]" :value="__('Status')" />
                                    <x-select
                                        wire:model.lazy="orderServices.{{$index}}.status"
                                        name="orderServices[{{ $index }}][status]"
                                        id="orderServices[{{ $index }}][status]" class="w-full text-sm"
                                        :has-error="$errors->has('orderServices.'.$index.'.status')">
                                        <option value="pendiente">Pendiente</option>
                                        <option value="cancelado">Cancelado</option>
                                        <option value="completado">Completado</option>
                                    </x-select>
                                    <x-forms.error name="orderServices.{{ $index }}.status" />
                                </div>
                                {{-- Driver --}}
                                <div>
                                    <x-label for="orderServices[{{ $index }}][driver]" :value="__('Driver')" />
                                    <x-select
                                        wire:model.lazy="orderServices.{{$index}}.driver"
                                        name="orderServices[{{ $index }}][driver]"
                                        id="orderServices[{{ $index }}][driver]" class="w-full text-sm"
                                        :has-error="$errors->has('orderServices.'.$index.'.driver')">
                                        <option value="1">{{ __('Select driver') }}</option>
                                        @foreach ($drivers as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-forms.error name="orderServices.{{ $index }}.driver" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-9 gap-4 sm:gap-1 mt-4">
                                {{-- Pickup --}}
                                <div class="col-span-3">
                                    <x-label for="orderServices[{{ $index }}][pickup]" :value="__('Pickup')" />
                                    <x-input
                                        wire:model.lazy="orderServices.{{$index}}.pickup"
                                        type="text"
                                        name="orderServices[{{ $index }}][pickup]"
                                        id="orderServices[{{ $index }}][pickup]" class="w-full text-sm"
                                        :value="old('orderServices[{{ $index }}][pickup]')"
                                        :has-error="$errors->has('orderServices.'.$index.'.pickup')" />
                                    <x-forms.error name="orderServices.{{ $index }}.pickup" />
                                </div>
                                {{-- Dropoff --}}
                                <div class="col-span-3">
                                    <x-label for="orderServices[{{ $index }}][dropoff]" :value="__('Dropoff')" />
                                    <x-input
                                        wire:model.lazy="orderServices.{{$index}}.dropoff"
                                        type="text"
                                        name="orderServices[{{ $index }}][dropoff]"
                                        id="orderServices[{{ $index }}][dropoff]" class="w-full text-sm"
                                        :value="old('orderServices[{{ $index }}][dropoff]')"
                                        :has-error="$errors->has('orderServices.'.$index.'.dropoff')" />
                                    <x-forms.error name="orderServices.{{ $index }}.dropoff" />
                                </div>
                                {{-- Note --}}
                                <div class="col-span-3">
                                    <x-label for="orderServices[{{ $index }}][note]" :value="__('Note')" />
                                    <x-textarea
                                        wire:model.lazy="orderServices.{{$index}}.note"
                                        name="orderServices[{{ $index }}][note]"
                                        id="orderServices[{{ $index }}][note]"
                                        class="w-full text-sm"
                                        :has-error="$errors->has('orderServices.'.$index.'.note')">
                                    </x-textarea>
                                    <x-forms.error name="orderServices.{{ $index }}.note" />
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button wire:click.prevent="removeServiceRow({{ $index }})" type="button" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded p-2">
                                    <span>{{ trans('Remove') }}</span>
                                </button>
                            </div>
                        </section>
                    @empty
                        <section class="bg-blue-200 text-blue-700 px-4 py-2 rounded inline-flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p>{{ trans('Click Add New Service button for assign a new service to the order') }}</p>
                        </section>
                    @endforelse
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script>
                        flatpickr(".time",{
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            time_24hr: true
                        });
                    </script>
                </div>

                <x-button wire:click.prevent="addServiceRow">
                    <span>{{ trans('Add New Service') }}</span>
                </x-button>
            </section>

            <div class="flex justify-end mt-10">
                <x-button type="submit">
                    {{ trans('Create') }}
                </x-button>
            </div>

        </form>
    </x-card>
</div>
