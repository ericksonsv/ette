<x-app-layout>

    <x-slot name="header">
        <x-layouts.header-title :text="__('Service Management')" />
    </x-slot>

    <div class="flex justify-end mb-6 space-x-1">
        <x-link :href="route('orders.index')"><span>{{ trans('Back to List') }}</span></x-link>
        <x-link href="{{ route('print.service', $service->id) }}" target="__new" class="bg-indigo-500 hover:bg-indigo-700">
            <span>{{ trans('Print') }}</span>
        </x-link>
    </div>

    <x-card>
        <x-card.header :text="trans('Editing Order Service')" />

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-2">
                <div>
                    <x-label for="company" :value="__('Company')" />
                    <x-input type="text" name="company" id="company" class="w-full max-w-xl" :value="$service->order->company" :has-error="$errors->has('company')" />
                    <x-forms.error name="company" />
                </div>
                <div>
                    <x-label for="client_name" :value="__('Client Name')" />
                    <x-input type="text" name="client_name" id="client_name" class="w-full max-w-xl" :value="$service->order->client_name" :has-error="$errors->has('client_name')" />
                    <x-forms.error name="client_name" />
                </div>
                <div>
                    <x-label for="client_email" :value="__('Client Email')" />
                    <x-input type="email" name="client_email" id="client_email" class="w-full max-w-xl" :value="$service->order->client_email" :has-error="$errors->has('client_email')" />
                    <x-forms.error name="client_email" />
                </div>
                <div>
                    <x-label for="client_phone" :value="__('Client Phone')" />
                    <x-input type="text" name="client_phone" id="client_phone" class="w-full max-w-xl" :value="$service->order->client_phone" :has-error="$errors->has('client_phone')" />
                    <x-forms.error name="client_phone" />
                </div>
            </div>

            <section class="my-10 flex-1">

                <div class="grid grid-cols-1 sm:grid-cols-5 gap-1">
                    {{-- Date --}}
                    <div>
                        <x-label for="date" :value="__('Date')" />
                        <x-input
                            type="date"
                            name="date"
                            id="date" class="date w-full text-sm"
                            :value="$service->date->toDateString()" :has-error="$errors->has('date')"
                        />
                        <x-forms.error name="date" />
                    </div>
                    {{-- Time --}}
                    <div>
                        <x-label for="time" :value="__('Pickup Time')" />
                        <x-time-picker
                            name="time"
                            id="time" :value="displayTime($service->time)" :has-error="$errors->has('time')"
                            class="w-full text-sm" />
                        <x-forms.error name="time" />
                    </div>
                    {{-- Flight --}}
                    <div>
                        <x-label for="flight" :value="__('Flight')" />
                        <x-input
                            type="text"
                            name="flight"
                            id="flight" class="w-full text-sm"
                            :value="$service->flight"
                            :has-error="$errors->has('flight')" />
                        <x-forms.error name="flight" />
                    </div>
                    {{-- Flight Time --}}
                    <div>
                        <x-label for="flight_time" :value="__('Flight Time')" />
                        <x-time-picker
                            name="flight_time"
                            id="flight_time" :value="displayTime($service->flight_time)" :has-error="$errors->has('flight_time')"
                            class="w-full text-sm" />
                        <x-forms.error name="flight_time" />
                    </div>
                    {{-- Passengers --}}
                    <div>
                        <x-label for="passengers" :value="__('Passengers')" />
                        <x-input
                            type="number"
                            min="1"
                            name="passengers"
                            id="passengers" class="w-full text-sm"
                            :value="$service->passengers"
                            :has-error="$errors->has('passengers')" />
                        <x-forms.error name="passengers" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-5 gap-1 mt-4">
                    {{-- Currency --}}
                    <div>
                        <x-label for="currency" :value="__('Currency')" />
                        <x-select
                            name="currency"
                            id="currency" class="w-full text-sm"
                            :has-error="$errors->has('currency')">
                            <option value="DOP" {{ $service->currency == 'DOP' ? 'selected' : '' }}>DOP</option>
                            <option value="USD" {{ $service->currency == 'USD' ? 'selected' : '' }}>USD</option>
                        </x-select>
                        <x-forms.error name="currency" />
                    </div>
                    {{-- Amount --}}
                    <div>
                        <x-label for="amount" :value="__('Amount')" />
                        <x-input
                            type="number" min="0" step="0.00"
                            name="amount"
                            id="amount" class="w-full text-sm"
                            :value="$service->amount"
                            :has-error="$errors->has('amount')" />
                        <x-forms.error name="amount" />
                    </div>
                    {{-- Type --}}
                    <div>
                        <x-label for="type" :value="__('Type')" />
                        <x-select
                            name="type"
                            id="type" class="w-full text-sm"
                            :has-error="$errors->has('type')">
                            <option value="standard" {{ $service->type == 'standard' ? 'selected' : '' }}>{{ trans('Standard') }}</option>
                            <option value="corporate" {{ $service->type == 'corporate' ? 'selected' : '' }}>{{ trans('Corporate') }}</option>
                        </x-select>
                        <x-forms.error name="type" />
                    </div>
                    {{-- Status --}}
                    <div>
                        <x-label for="status" :value="__('Status')" />
                        <x-select
                            name="status"
                            id="status" class="w-full text-sm"
                            :has-error="$errors->has('status')">
                            <option value="pendiente" {{ $service->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="cancelado" {{ $service->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            <option value="completado" {{ $service->status == 'completado' ? 'selected' : '' }}>Completado</option>
                        </x-select>
                        <x-forms.error name="status" />
                    </div>
                    {{-- Driver --}}
                    <div>
                        <x-label for="driver" :value="__('Driver')" />
                        <x-select
                            name="driver"
                            id="driver" class="w-full text-sm"
                            :has-error="$errors->has('driver')">
                            <option value="1">{{ __('Select driver') }}</option>
                            @foreach ($drivers as $id => $name)
                                <option value="{{ $id }}" {{ $service->driver_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </x-select>
                        <x-forms.error name="driver" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-9 gap-1 mt-4">
                    {{-- Pickup --}}
                    <div class="col-span-3">
                        <x-label for="pickup" :value="__('Pickup')" />
                        <x-input
                            type="text"
                            name="pickup"
                            id="pickup" class="w-full text-sm"
                            :value="$service->pickup"
                            :has-error="$errors->has('pickup')" />
                        <x-forms.error name="pickup" />
                    </div>
                    {{-- Dropoff --}}
                    <div class="col-span-3">
                        <x-label for="dropoff" :value="__('Dropoff')" />
                        <x-input
                            type="text"
                            name="dropoff"
                            id="dropoff" class="w-full text-sm"
                            :value="$service->dropoff"
                            :has-error="$errors->has('dropoff')" />
                        <x-forms.error name="dropoff" />
                    </div>
                    {{-- Note --}}
                    <div class="col-span-3">
                        <x-label for="note" :value="__('Note')" />
                        <x-textarea
                            name="note"
                            id="note"
                            class="w-full text-sm"
                            :has-error="$errors->has('note')">
                            {{ $service->note }}
                        </x-textarea>
                        <x-forms.error name="note" />
                    </div>
                </div>

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            </section>


            <div class="flex justify-end mt-10">
                <x-button type="submit">
                    {{ trans('Update') }}
                </x-button>
            </div>
        </form>

    </x-card>

</x-app-layout>
