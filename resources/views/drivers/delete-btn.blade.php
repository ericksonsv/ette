@can('delete-driver')
    <x-tables.delete-button wire:click.stop.prevent="removeRow({{$row}})" href="#" :text="__('Delete')" onclick="confirm('¿Deseas eliminar este chofer?') || event.stopImmediatePropagation()" />
@endcan