@if ($row)
    <p class="inline-flex justify-center text-xs text-white font-bold px-3 py-1 rounded bg-blue-400">
        <span>Activo</span>
    </p>
@else
    <p class="inline-flex justify-center text-xs text-white font-bold px-3 py-1 rounded bg-red-400">
        <span>Inactivo</span>
    </p>
@endif