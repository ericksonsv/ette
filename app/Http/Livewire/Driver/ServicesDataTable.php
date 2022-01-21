<?php

namespace App\Http\Livewire\Driver;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;

class ServicesDataTable extends DataTableComponent
{
    public $driver;

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->sortable()->searchable(),
            Column::make('Cliente', 'order.client_name')
                ->addClass('w-full')
                ->sortable()
                ->searchable(),
            Column::make('Fecha', 'date')->sortable()->format(function ($row) {
                return $row->toFormattedDateString();
            }),
            Column::make('Estatus', 'status')->sortable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('services.edit', $row);
    }

    public function query(): Builder
    {
        return Service::query()->where('driver_id', '=', $this->driver);
    }
}
