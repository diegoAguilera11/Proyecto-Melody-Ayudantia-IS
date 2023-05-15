@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('title-page')
    Bienvenido {{ auth()->user()->name }}
@endsection
@section('content')
    @if (auth()->user()->role === 1)
        {{-- Opciones Cliente --}}

        @if ($concerts->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($concerts as $concert)
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-500 dark:border-gray-700">
                        <a href="#">
                            <img class="p-8 rounded-t-lg" src="{{ asset('img/concert.png') }}" alt="concert image" />
                        </a>
                        <div class="px-5 pb-5">
                            <a href="#">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $concert->name }}
                                </h5>
                            </a>

                            <p class="text-sm font-bold tracking-tight text-gray-900 dark:text-white uppercase">
                                Stock: {{ $concert->stock }}
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ '$' . $concert->price }}
                                </span>

                                @if ($concert->stock > 0)
                                    <!-- Modal toggle -->
                                    <button data-modal-toggle="defaultModal-{{ $concert->id }}"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                        type="button">
                                        Comprar entrada
                                    </button>
                                @else
                                    <button href="#" id="add-concert"
                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 cursor-not-allowed disabled: opacity-75 ">
                                        Agotado
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Main modal -->
                    <div id="defaultModal-{{ $concert->id }}" tabindex="-1" aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Terms of Service
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="defaultModal-{{ $concert->id }}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        With less than a month to go before the European Union enacts new consumer privacy
                                        laws for its citizens, companies around the world are updating their terms of
                                        service agreements to comply.
                                    </p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect
                                        on May 25 and is meant to ensure a common set of data rights in the European Union.
                                        It requires organizations to notify users as soon as possible of high-risk data
                                        breaches that could personally affect them.
                                    </p>
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-toggle="defaultModal-{{ $concert->id }}" type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Realizar compra
                                    </button>
                                    <button data-modal-toggle="defaultModal-{{ $concert->id }}" type="button"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

    @if (auth()->user()->role === 2)
        {{-- Opciones Administrador --}}
        <div class="md:flex-col md:justify-center bg-gray-800 p-6 rounded-lg shadow-lg ">
            <h2 class="text-center text-white uppercase font-bold text-3xl p-6">Selecciona una opción</h2>
            <div class="md:flex md:justify-evenly">
                <div>
                    <a href="{{ route('concert.create') }}"
                        class="text-center text-black font-bold p-3 bg-red-500 rounded hover:bg-red-800 transition">Agregar
                        Concierto</a>
                </div>
            </div>
        </div>
    @endif
@endsection
