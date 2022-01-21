<?php

namespace App\Http\Livewire\Driver;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Driver;

class DataTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'name')->sortable()->searchable(),
            Column::make('Teléfono', 'phone')->sortable()->searchable()->addClass('w-full'),
            Column::make('Estatus', 'active')->sortable()->format(function ($row) {
                return view('drivers.status', compact('row'));
            }),
            Column::make('', 'id')->sortable()->hideIf(! auth()->user()->is_admin)->format(function ($row) {
                return view('drivers.delete-btn', compact('row'));
            }),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('drivers.edit', $row);
    }

    public function removeRow($row): void
    {
        $driver = Driver::find($row);

        if (request()->user()->cannot('delete-driver', $driver) || $driver->id === 1) {
            $this->redirectIfError();
            return;
        }

        if (count($driver->services)) {
            $this->redirectIfDriverServices();
            return;
        }

        Driver::destroy($row);

        $this->redirectAfterDelete();
    }



    public function redirectIfDriverServices()
    {
        session()->flash('warning', __('This driver has services assigned cannot be deleted.'));

        return redirect()->route('drivers.index');
    }

    public function redirectIfError()
    {
        session()->flash('warning', __('Action not Authorized.'));

        return redirect()->route('drivers.index');
    }

    public function redirectAfterDelete()
    {
        session()->flash('success', __('Driver deleted.'));

        return redirect()->route('drivers.index');
    }

    public function query(): Builder
    {
        return Driver::query()->whereNotIn('id', [1]);
    }
}
