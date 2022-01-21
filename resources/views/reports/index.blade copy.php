<x-app-layout>
    <x-slot name="header">
        <x-layouts.header-title :text="__('Reports')" />
    </x-slot>
    {{-- <div class="flex justify-end mb-6">
        <x-link :href="route('users.create')"><span>{{ trans('Add User') }}</span></x-link>
    </div> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <div>
        <table id="reports-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Company</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Driver</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->order->company }}</td>
                        <td>{{ $service->order->client_name }}</td>
                        <td>{{ $service->date->toFormattedDateString() }}</td>
                        <td>{{ $service->time->format('H:i') }}</td>
                        <td>{{ $service->driver->name }}</td>
                        <td>{{ $service->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
    <script>
        let table = new DataTable('#reports-table', {
            paging: false,
            dom: 'Bfrtip',
            buttons: [
            'pdf',
                {
                    extend: 'excel',
                    messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column'
                }
            ]
        });
    </script>

</x-app-layout>
