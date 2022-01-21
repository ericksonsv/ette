<?php

namespace App\Http\Livewire\User;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class DataTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'name')->sortable()->searchable(),
            Column::make('Correo', 'email')->sortable()->searchable(),
            Column::make('Tipo', 'is_admin')->sortable()->addClass('w-full')->format(function ($row) {
                return $row ? 'Admin' : 'Usuario';
            }),
            Column::make('Estatus', 'active')->sortable()->format(function ($row) {
                return view('users.status', compact('row'));
            }),
            Column::make('', 'id')->sortable()->format(function ($row) {
                return view('users.delete-btn', compact('row'));
            }),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('users.edit', $row);
    }

    public function removeRow($row): void
    {
        $user = User::find($row);

        if (request()->user()->cannot('delete', $user) || $user->id === 1) {
            $this->redirectIfError();
            return;
        }

        User::destroy($row);

        $this->redirectAfterDelete();
    }

    public function redirectIfError()
    {
        session()->flash('warning', __('Action not Authorized.'));

        return redirect()->route('dashboard');
    }

    public function redirectAfterDelete()
    {
        session()->flash('success', __('User deleted.'));

        return redirect()->route('users.index');
    }

    public function query(): Builder
    {
        return User::query()->whereNotIn('id', [1]);
    }
}
