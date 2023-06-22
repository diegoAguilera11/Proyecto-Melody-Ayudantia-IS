@extends('layouts.app')

@section('title')
    Conciertos
@endsection

@section('content')
    @if ($concerts->count())
        <div class="relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Nombre
                            </p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Fecha Concierto
                            </p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Cantidad Entradas
                            </p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Cantidad Entradas Vendidas
                            </p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Cantidad Entradas Disponibles
                            </p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Monto Total Vendido
                            </p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="text-center">
                                Acción
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($concerts as $concert)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            {{-- Nombre Concierto --}}
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p class="text-center">
                                    {{ $concert->name }}
                                </p>
                            </td>
                            {{-- Fecha Concierto --}}
                            <td class="px-6 py-4">
                                <p class="text-center">
                                    {{ date('d/m/Y', strtotime($concert->date)) }}
                                </p>
                            </td>
                            {{-- Cantidad Entradas --}}
                            <td class="px-6 py-4">
                                <p class="text-center">
                                    {{ $concert->stock }}
                                </p>
                            </td>
                            {{-- Cantidad Entradas Vendidas --}}
                            <td class="px-6 py-4">
                                @if ($concert->stock != $concert->current_stock)
                                    <p class="text-center">
                                        {{ $concert->stock - $concert->current_stock }}
                                    </p>
                                @else
                                    <p class="text-center">
                                        0
                                    </p>
                                @endif
                            </td>
                            {{-- Cantidad Entradas Disponibles --}}
                            <td class="px-6 py-4">
                                <p class="text-center">
                                    {{ $concert->current_stock }}
                                </p>
                            </td>
                            {{-- Monto Total Vendido --}}
                            <td class="px-6 py-4">
                                <p class="text-center">
                                    @if ($concert->detail_order_sum_total)
                                        {{ $concert->detail_order_sum_total }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </td>
                            @if ($concert->stock != $concert->current_stock)
                                {{-- Ver detalles --}}
                                <td class="px-6 py-4">
                                    <a data-tooltip-target="tooltip-right-conciertos" data-tooltip-placement="right"
                                        href="{{ route('concert.clients', ['id' => $concert->id]) }}">
                                        <img class="m-auto" src="{{ asset('img/file.png') }}" alt="pdf-image">
                                    </a>

                                    <div id="tooltip-right-conciertos" role="tooltip"
                                        class="text-center absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Visualiza el listado de conciertos
                                        <br>
                                        que ofrece Melody.
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                </td>
                            @else
                                <td class="px-6 py-4">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-2xl text-white text-center font-bold">no hay conciertos por mostrar</p>
    @endif
@endsection
