@extends('layouts.app')

@section('title')
    {{ auth()->user()->name }}
@endsection

@section('content')
    @if (session('success'))
    @endif
    {{-- Opciones Administrador --}}
    <div class="md:flex-col md:justify-center bg-cyan-800 p-6 rounded-lg shadow-lg ">
        <h2 class="text-center text-white uppercase font-bold text-3xl p-6">Selecciona una opción</h2>

        <div class="md:flex md:justify-evenly">

            {{-- Agregar Concierto --}}
            <div>
                <a data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" href="{{ route('concert.create') }}"
                    class="text-center text-black font-bold p-3 rounded bg-red-500 hover:bg-red-800 transition-all">
                    Agregar Concierto
                </a>
                <div id="tooltip-bottom" role="tooltip"
                    class="text-center absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Crea los próximos conciertos
                    <br>
                    disponibles para los clientes de Melody.
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>

            {{-- Compras Realizadas --}}
            <div>
                <a data-tooltip-target="tooltip-bottom-compras" data-tooltip-placement="bottom"
                    href="{{ route('concerts') }}"
                    class="text-center text-black font-bold p-3 bg-red-500 hover:bg-red-800 rounded transition-all">Compras
                    Realizadas
                </a>
                <div id="tooltip-bottom-compras" role="tooltip"
                    class="text-center absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Revisa las compras realizadas
                    <br>
                    por los clientes de Melody.
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>

            {{-- Buscar Cliente --}}
            <div>
                <a data-tooltip-target="tooltip-bottom-cliente" data-tooltip-placement="bottom"
                    href="#"
                    class="text-center text-black font-bold p-3 bg-red-500 hover:bg-red-800 rounded transition-all">
                    Buscar Cliente
                </a>
                <div id="tooltip-bottom-cliente" role="tooltip"
                    class="text-center absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Visualiza el historial de compras
                    <br>
                    de un cliente en Melody.
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>

            {{-- Recaudación --}}
            <div>
                <a data-tooltip-target="tooltip-bottom-recaudacion" data-tooltip-placement="bottom"
                    href="#"
                    class="text-center text-black font-bold p-3 bg-red-500 hover:bg-red-800 rounded transition-all">
                    Recaudación
                </a>
                <div id="tooltip-bottom-recaudacion" role="tooltip"
                    class="text-center absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Visualiza la recaudación
                    <br>
                    de las ventas realizadas en Melody.
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>

        <script></script>
    @endsection
