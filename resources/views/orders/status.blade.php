@if ($row == 'completado')
    <p class="inline-flex justify-center text-xs text-white font-bold p-1 rounded bg-blue-400">
        <span class="uppercase">{{ $row }}</span>
    </p>
@elseif($row == 'pendiente')
    <p class="inline-flex justify-center text-xs text-white font-bold p-1 rounded bg-yellow-400">
        <span class="uppercase">{{ $row }}</span>
    </p>
@elseif($row == 'cancelado')
    <p class="inline-flex justify-center text-xs text-white font-bold p-1 rounded bg-red-400">
        <span class="uppercase">{{ $row }}</span>
    </p>
@endif
