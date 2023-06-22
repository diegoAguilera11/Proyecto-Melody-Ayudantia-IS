@extends('layouts.app')

@section('title')
    {{ $concert->name }}
@endsection

@section('content')
    <div class="flex flex-row justify-end">
        <a href="{{ route('concerts') }}"
            class="text-center text-black font-bold p-3 bg-blue-500 rounded hover:bg-blue-800 transition">
            Volver
        </a>
    </div>
    <h2 class="text-center text-white uppercase font-bold text-3xl p-6">{{ $concert->name }} -
        {{ date('d/m/Y', strtotime($concert->date)) }} </h2>
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
                            Correo Electrónico
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Fecha Compra
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Cantidad Entradas Compradas
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Medio de Pago
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-center">
                            Total Pagado
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_orders as $detail_order)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        {{-- Numero de reserva --}}
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="text-center">
                                {{ $detail_order->reservation_number }}
                            </p>
                        </td>
                        {{-- Nombre del CLiente --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $clients->find($detail_order->user_id)->name }}
                            </p>
                        </td>
                        {{-- Correo Electrónico del Cliente --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $clients->find($detail_order->user_id)->email }}
                            </p>
                        </td>
                        {{-- Fecha de Compra --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ date('d/m/Y h:i:s', strtotime($detail_order->created_at)) }}
                            </p>
                        </td>
                        {{-- Cantidad Entradas Compradas --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $detail_order->quantity }}
                            </p>
                        </td>
                        {{-- Medio de Pago --}}
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

                        {{-- Total Pagado --}}
                        <td class="px-6 py-4">
                            <p class="text-center">
                                {{ $detail_order->total }}
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
