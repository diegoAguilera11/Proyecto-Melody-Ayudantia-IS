@extends('layouts.app')


@section('content')

    <form action="{{ route('client.search') }}" class="my-12" method="POST" novalidate>
        @csrf
        <div class="flex items-center">
            <label for="email_search" class="sr-only">Search</label>
            <div class="relative w-full">
                <input type="email" name="email_search" placeholder="Ingresa un email a buscar"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <button type="submit"
                class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span class="sr-only">Search</span>
            </button>

            <a type="button" href={{ route('clients.list') }}
                class="p-2.5 ml-2 text-sm font-medium text-white bg-amber-500 rounded-lg hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh hover:animate-spin"
                    width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                <span class="sr-only">Search</span>
            </a>
        </div>
        @error('email_search')
            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">
                {{ $message }}</p>
        @enderror
    </form>


    @if ($client == null)
    @elseif($client->concertsClient()->count() > 0)
        <h2 class="text-center text-white text-3xl font-bold uppercase my-10">Cliente {{ $client->name }}</h2>
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
                    @foreach ($client->concertsClient as $detail_order)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            {{-- Numero de reserva --}}
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p class="text-center">
                                    {{ $detail_order->reservation_number }}
                                </p>
                            </td>
                            {{-- Nombre de Concierto --}}
                            <td class="px-6 py-4">
                                <p class="text-center">
                                    {{ $detail_order->concertDate->name }}
                                </p>
                            </td>
                            {{-- Fecha Concierto --}}
                            <td class="px-6 py-4">
                                <p class="text-center">
                                    {{ date('d/m/Y', strtotime($detail_order->concertDate->date)) }}
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
                                <a class="w-auto h-auto"
                                    href="{{ route('pdf.descargar', ['id' => $detail_order->voucher->id]) }}">
                                    <img class="mx-auto" src="{{ asset('img/pdf.png') }}" alt="pdf-image">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-2xl text-white text-center font-bold">No hay clientes por mostrar</p>
    @endif
@endsection
