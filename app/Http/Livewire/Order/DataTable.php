<?php

namespace App\Http\Livewire\Order;

use App\Models\Driver;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class DataTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->sortable()->searchable(),
            Column::make('Compañia', 'order.company')->sortable()->searchable(),
            Column::make('Cliente', 'order.client_name')->sortable()->searchable(),
            Column::make('Fecha', 'date')->sortable()->format(function ($row) {
                return $row->toFormattedDateString();
            }),
            Column::make('Hora para recoger', 'time')->sortable()->format(function ($row) {
                return $row->format('H:i');
            }),
            // Column::make('Chofer', 'driver.name')->sortable()->searchable(),
            Column::make('Chofer', 'id')->addClass('w-full')->searchable()->format(function ($row) {
                $order = Service::find($row);
                return view('orders.driver-select', [
                    'row' => $order,
                    'drivers' => Driver::where('active', true)->pluck('name', 'id')
                ]);
            }),
            Column::make('Chofer', 'driver.name')->hideIf(! auth()->user()->is_dmin)->sortable()->searchable()->format(function ($row) {
                return view('orders.modal-select-driver', compact('row'));
            }),
            Column::make('Estatus', 'status')->sortable()->format(function ($row) {
                return view('orders.status', compact('row'));
            }),
            Column::make('', 'id')->format(function ($row) {
                $order = Service::find($row);
                return view('orders.table-options', [
                    'row' => $order,
                    'drivers' => Driver::where('active', true)->pluck('name', 'id')
                ]);
            }),
        ];
    }

    public function setTableClass(): ?string
    {
        return 'whitespace-nowrap w-full';
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('Estatus', ['status'])->select([
                '' => 'Todos',
                'pendiente' => 'Pendiente',
                'cancelado' => 'Cacelado',
                'completado' => 'Completado',
            ]),
            'date' => Filter::make('Fecha', ['date'])->date(),
            'date_from' => Filter::make('Fecha desde', ['date'])->date(),
            'date_to' => Filter::make('Fecha hasta', ['date'])->date(),
        ];
    }

    public function removeRow($row): void
    {
        $service = Service::find($row);
        $order = Order::find($service->order_id);

        if (request()->user()->cannot('delete', $service)) {
            $this->redirectIfError();
            return;
        }

        Service::destroy($row);

        if (!count($order->services)) {
            Order::destroy($order->id);
        }

        $this->redirectAfterDelete();
    }

    public function redirectIfError()
    {
        session()->flash('warning', __('Action not Authorized.'));

        return redirect()->route('orders.index');
    }

    public function redirectAfterDelete()
    {
        session()->flash('success', __('Service deleted.'));

        return redirect()->route('orders.index');
    }

    public function changeDriver($value, $row)
    {
        $service = Service::find($row['id']);

        if (request()->user()->cannot('assign-driver', $row)) {
            $this->redirectIfError();
            return;
        }

        $service->update([
            'driver_id' => $value
        ]);
        $service->save();
        session()->flash('success', __('Order Updated'));
        return redirect()->route('orders.index');
    }

    public function query(): Builder
    {
        return Service::query()
            ->when($this->getFilter('status'), fn ($query, $type) => $query->where('status', $type))
            ->when($this->getFilter('date'), fn ($query, $date) => $query->where('date', $date))
            ->when($this->getFilter('date_from'), fn ($query, $date) => $query->where('date', '>=', $date))
            ->when($this->getFilter('date_to'), fn ($query, $date) => $query->where('date', '<=', $date));
    }
}
