<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0px;
            padding: 0px;
        }

        .dataTables_filter,
        .dt-buttons {
            padding-bottom: 16px;
        }

        table.dataTable {
            font-size: 14px;
            text-align: left;
            border-collapse: collapse;
        }

        table.dataTable td,
        table.dataTable th {
            border: solid 1px rgba(230, 230, 230, 1);
        }

        table.dataTable.no-footer {
            border-bottom: 0px;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            border-bottom: 0px;
            background-color: rgba(240, 240, 240, 1);
        }

        table.dataTable.compact thead th,
        table.dataTable.compact thead td {
            padding: 4px 17px 4px 4px;
        }

        .filters-container {
            display: flex;
            justify-content: end;
            align-items: end;
            flex-direction: column;
        }

        .date {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            margin-bottom: 3px;
        }

    </style>
</head>

<body>
    <div style="padding: 16px">
        <h1 style="text-align: center; margin-bottom: 16px;">{{ trans('Services Reports') }}</h1>

        <div class="filters-container">
            <h3 style="margin-bottom: 16px">{{ trans('Custom Filters') }}</h3>
            <div>
                <label>
                    <span>{{ trans('Date From') }}:</span>
                    <input type="text" name="min" class="date" id="min">
                </label>
            </div>
            <div>
                <label>
                    <span>{{ trans('Date To') }}:</span>
                    <input type="text" name="max" class="date" id="max">
                </label>
            </div>
        </div>

        <table id="reports-table" class="compact">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Compañia</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Hora Recogida</th>
                    <th>Recoger</th>
                    <th>Dejar</th>
                    <th>Vuelo</th>
                    <th>Hora Vuelo</th>
                    <th>Pasajeros</th>
                    {{-- <th>Monto</th> --}}
                    <th>Chofer</th>
                    {{-- <th>Estatus</th> --}}
                    {{-- <th>Creado</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->order->company }}</td>
                        <td>{{ $service->order->client_name }}</td>
                        <td>{{ $service->date->toDateString() }}</td>
                        <td>{{ $service->time->format('H:i') }}</td>
                        <td>{{ $service->pickup }}</td>
                        <td>{{ $service->dropoff }}</td>
                        <td>{{ $service->flight }}</td>
                        <td>{{ displayTime($service->flight_time) }}</td>
                        <td>{{ $service->passengers }}</td>
                        {{-- <td>{{ $service->currency }}{{ $service->amount }}</td> --}}
                        <td>{{ $service->driver->name }}</td>
                        {{-- <td>{{ $service->status }}</td> --}}
                        {{-- <td>{{ $service->created_at->diffForHumans() }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script> --}}
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

    <script src="{{  asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/jszip.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/pdfmake.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/vfs_fonts.js') }}"></script>
    <script src="{{  asset('vendor/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/buttons.print.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/moment.min.js') }}"></script>
    <script src="{{  asset('vendor/datatables/dataTables.dateTime.min.js') }}"></script>
    {{-- <script>
        let table = new DataTable('#reports-table', {
            paging: false,
            dom: 'Bfrtip',
            buttons: [
                'pdf',
                {
                    extend: 'excel',
                    messageTop: 'The information in this table is copyright to Edwin TTE.'
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column'
                }
            ]
        });
    </script> --}}
    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[3]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {

            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY',
                buttons: {
                    today: true,
                    clear: true
                }
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY',
                buttons: {
                    today: true,
                    clear: true
                }
            });

            // DataTables initialisation
            var table = $('#reports-table').DataTable({
                paging: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        autoPrint: false,
                        messageTop: '<h3 style="text-align: center; margin: 0px; margin-bottom: 16px">Esta Información es provista por Edwin TTE</h3>',
                        title: '<h2 style="text-align: center; margin: 0px">Edwin TTE</h2>'
                    },
                    {
                        extend: 'pdf',
                        messageTop: '<h3 style="text-align: center; margin: 0px; margin-bottom: 16px">Esta Información es provista por Edwin TTE</h3>',
                        title: '<h2 style="text-align: center; margin: 0px">Edwin TTE</h2>'
                    },
                    {
                        extend: 'excel',
                        messageTop: '<h3 style="text-align: center; margin: 0px; margin-bottom: 16px">Esta Información es provista por Edwin TTE</h3>',
                        title: '<h2 style="text-align: center; margin: 0px">Edwin TTE</h2>'
                    },
                ]
            });

            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });

        });
    </script>
</body>

</html>
