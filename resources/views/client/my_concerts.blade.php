@extends('layouts.app')

@section('title')
    Mis conciertos
@endsection


@section('content')

    <h2 class="font-bold mb-10 text-3xl text-white text-center">Mis Conciertos</h2>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            N° Reserva
                        </p>
                    </th>
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
                            Fecha Compra
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Cantidad Entradas
                        </p>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Total Pagado
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Medio de Pago
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Descargar
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->concertsClient as $detail_order)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        {{-- Numero de reserva --}}
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="text-center">
                                {{ $detail_order->reservation_number }}
                            </p>
                        </td>
                        {{-- Nombre de Concierto --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $detail_order->concertDates->name }}
                            </p>
                        </td>
                        {{-- Fecha Concierto --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ date('d/m/Y', strtotime($detail_order->concertDates->date)) }}
                            </p>
                        </td>
                        {{-- Fecha Compra --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ date('d/m/Y H:i:s', strtotime($detail_order->created_at)) }}
                            </p>
                        </td>
                        {{-- Cantidad Entradas --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $detail_order->quantity }}
                            </p>
                        </td>
                        {{-- Total Pagado --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $detail_order->total }}
                            </p>
                        </td>
                        {{-- Medio Pago --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                @switch($detail_order->payment_method)
                                    @case('1')
                                        Efectivo
                                    @break

                                    @case('2')
                                        Transferencia
                                    @break

                                    @case('3')
                                        Débito
                                    @break

                                    @case('4')
                                        Crédito
                                    @break
                                @endswitch
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <a class="w-auto h-auto" href="{{ route('pdf.descargar', ['id' => $detail_order->voucher->id]) }}">
                                <img class="mx-auto" src="{{ asset('img/pdf.png') }}" alt="pdf-image">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
