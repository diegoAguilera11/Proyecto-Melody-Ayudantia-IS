@extends('layouts.app')

@section('title')
    Mis conciertos
@endsection


@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor Entrada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stock
                    </th>

                    <th scope="col" class="px-6 py-3">
                        ID Concierto
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->concertsClient as $concert)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $concert->concertDate->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('d/m/Y', strtotime($concert->concertDate->date)) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $concert->concertDate->price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $concert->concertDate->stock }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $concert->concertDate->id }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
