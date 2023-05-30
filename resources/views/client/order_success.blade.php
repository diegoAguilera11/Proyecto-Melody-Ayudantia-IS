@extends('layouts.app')

@section('title')
@endsection

@section('content')
    <div class="max-w-xl mx-auto my-4 border-b-2 pb-4 bg-gray-100 rounded p-4 mb-8">
        <div class="flex pb-3">
            <div class="flex-1">
            </div>

            <div class="flex-1">
                <div class="w-10 h-10 bg-green-500 mx-auto rounded-full text-lg text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="28"
                        height="28" viewBox="0 0 24 24" stroke-width="3" stroke="#000000" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </div>
            </div>


            <div class="w-1/4 align-center items-center align-middle content-center flex">
                <div class="w-full bg-green-400 rounded items-center align-middle align-center flex-1">
                    <div class="bg-green-light text-xs leading-none py-1 text-center text-grey-darkest rounded "
                        style="width: 100%"></div>
                </div>
            </div>


            <div class="flex-1">
                <div
                    class="w-10 h-10 bg-green-500 mx-auto rounded-full text-lg text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="28"
                        height="28" viewBox="0 0 24 24" stroke-width="3" stroke="#000000" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </div>
            </div>

            <div class="w-1/4 align-center items-center align-middle content-center flex">
                <div class="w-full bg-green-400 rounded items-center align-middle align-center flex-1">
                    <div class="bg-green-light text-xs leading-none py-1 text-center text-grey-darkest rounded "
                        style="width: 100%"></div>
                </div>
            </div>

            <div class="flex-1">
                <div
                    class="w-10 h-10 bg-green-500 mx-auto rounded-full text-lg text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="28"
                        height="28" viewBox="0 0 24 24" stroke-width="3" stroke="#000000" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </div>
            </div>

            <div class="flex-1">
            </div>

        </div>

        <div class="flex text-xs content-center text-center">
            <div class="w-1/3">
                <h3 class="status-font font-semibold text-lg">Selecciona tu concierto</h3>
            </div>

            <div class="w-1/3">
                <h3 class="status-font font-semibold text-lg">Método de pago</h3>
            </div>

            <div class="w-1/3">
                <h3 class="status-font font-semibold text-lg">Detalle</h3>
            </div>
        </div>
    </div>

    <div class="bg-slate-100 rounded lg:mx-60 sm:mx-32">

        <div class="flex flex-col items-center bg-red-300 rounded p-2 md:p-4  lg:mx-64 lg:p-4 xl:mx-32">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold mr-2">Nombre del concierto:</h2>
                <p class="text-2xl">{{ $detail_order->quantity }}</p>
            </div>

            <div class="flex items-center gap-2">
                <h2 class="text-xl font-semibold mr-2">Fecha:</h2>
                <p class="text-2xl">{{ $detail_order->quantity }}</p>
            </div>

            <div class="flex items-center gap-2">
                <h2 class="text-xl font-semibold mr-2">Valor entrada:</h2>
                <p class="text-2xl">{{ $detail_order->quantity }}</p>
            </div>

            <a class="p-4 bg-green-200 rounded-sm" href="{{ route('pdf.descargar', ['id' => $voucher->id]) }}">Descargar
                Pdf</a>
        </div>


        <div class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

            <a href="#" type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Volver
            </a>
        </div>
    </div>
@endsection

@section('alerts')
    <script>
        // Aqui va nuestro script de sweetalert
        const boton = document.getElementById("boton");
        const formulario = document.getElementById("formulario");

        boton.addEventListener('click', (e) => {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro que quieres enviar estos datos?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4DD091',
                cancelButtonColor: '#FF5C77',
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    formulario.submit();
                }
            })
        })
    </script>
@endsection
