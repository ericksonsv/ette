<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ trans('Service Order') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        @media print {
            .no-printme {
                display: none;
            }

            .printme {
                display: block;
            }

            body {
                line-height: 1.2;
            }
        }

        @page {
            size: A4 portrait;
            counter-increment: page;
        }

    </style>
</head>

<body class="text-gray-700 font-nunito">
    <!-- Print Template -->
    <header class="mb-6">
        <table class="w-full">
            <tr>
                <td>
                    <div class="leading-tight text-xs">
                        <x-application-logo class="h-12 mb-1" />
                        <p>{{ $settings->address }}</p>
                        <p>{{ trans('Phone') }}: {{ $settings->phone }}</p>
                        <p>{{ trans('Mobile') }}: {{ $settings->mobile }}</p>
                        <p>{{ trans('Email') }}: {{ $settings->email }}</p>
                        <p class="font-bold">{{ trans('RNC') }}: {{ $settings->rnc }}</p>
                    </div>
                </td>
                <td class="text-right align-middle">
                    <p>{{ trans('Date') }}: {{ now()->toFormattedDateString() }}</p>
                    <p class="font-bold text-lg uppercase">{{ trans('Order') }} #{{ $service->id }}</p>
                    {{-- <p><span class="font-bold">{{ trans('Driver') }}</span>: {{ $service->driver->name }}</p> --}}
                </td>
            </tr>
        </table>
    </header>

    <table class="w-full mb-6">
        <tr>
            <td>
                <p class="text-xl text-center uppercase">{{ trans('Invoice') }}</p>
            </td>
        </tr>
    </table>

    <table class="text-sm mb-4">
        <tbody>
            <tr>
                <td class="px-2 text-right font-bold">{{ trans('Client') }}:</td>
                <td class="px-2">{{ $service->order->client_name }}</td>
            </tr>
            <tr>
                <td class="px-2 text-right font-bold">{{ trans('Passengers') }}:</td>
                <td class="px-2">{{ $service->passengers }}</td>
            </tr>
            @if ($service->flight && $service->flight_time)
                <tr>
                    <td class="px-2 text-right font-bold">{{ trans('Flight') }}:</td>
                    <td class="px-2">{{ $service->flight }}</td>
                </tr>
                <tr>
                    <td class="px-2 text-right font-bold">{{ trans('Flight Time') }}:</td>
                    <td class="px-2">{{ $service->flight_time->toTimeString() }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <table class="w-full text-sm">
        <tbody>
            <tr>
                <td class="border px-2 py-1 text-right font-bold w-1">{{ trans('Date') }}:</td>
                <td class="border px-2 py-1">{{ $service->date->toFormattedDateString() }}</td>
                <td class="border px-2 py-1 text-right font-bold w-1">{{ trans('Time') }}:</td>
                <td class="border px-2 py-1">{{ $service->time->toTimeString() }}</td>
            </tr>
            <tr>
                <td class="border px-2 py-1 text-right font-bold w-1">{{ trans('Pickup') }}:</td>
                <td class="border px-2 py-1">{{ $service->pickup }}</td>
                <td class="border px-2 py-1 text-right font-bold w-1">{{ trans('Dropoff') }}:</td>
                <td class="border px-2 py-1">{{ $service->dropoff }}</td>
            </tr>
        </tbody>
    </table>

    <table class="w-full text-sm mt-6">
        <tbody>
            <tr>
                <td class="px-2 py-1 font-bold text-right text-lg">Total: {{ $service->currency }} {{ $service->amount }}</td>
            </tr>
        </tbody>
    </table>


    {{-- @if ($service->note)
        <table class="w-full mt-6 text-sm">
            <tr>
                <td colspan="6" class="border px-2 py-1 font-bold">{{ trans('Note') }}</td>
            </tr>
            <tr>
                <td colspan="6" class="border px-2 py-1">{{ $service->note }}</td>
            </tr>
        </table>
    @endif --}}
    <!-- /Print Template -->

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
