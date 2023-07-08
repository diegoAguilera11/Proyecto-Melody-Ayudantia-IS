@extends('layouts.app')
@section('title')
    Crear Concierto
@endsection

@push('sweetAlert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
@endpush

@section('content')
    <div class=" bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-center text-white uppercase font-bold text-3xl p-4">Registra un Concierto</h2>
        <div class="md:flex md:items-center gap-8">
            <div class="md:w-full">
                <form id="formulario" action="{{ route('concert') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="mb-2 block uppercase text-white font-bold">
                            Nombre
                        </label>
                        <input id="name" name="name"
                            class="border p-2 rounded-lg w-full
                    @error('name') border-red-600
                    @enderror" value="{{ old('name') }}"
                    value="{{ old('name') }}">
                        @error('name')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="price" class="mb-2 block uppercase text-white font-bold">
                            Precio
                        </label>
                        <input id="price" name="price"
                            class="border p-2 rounded-lg w-full
                    @error('price') border-red-600
                    @enderror" value="{{ old('price') }}"
                    value="{{ old('price') }}">
                        @error('price')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="stock" class="mb-2 block uppercase text-white font-bold">
                            Stock
                        </label>
                        <input id="stock" name="stock" type="text"
                            class="border p-2 rounded-lg w-full
                    @error('stock') border-red-600
                    @enderror" value="{{ old('stock') }}"
                    value="{{ old('stock') }}">
                        @error('stock')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="date" class="mb-2 block uppercase text-white font-bold">
                            Fecha
                        </label>
                        <input id="date" name="date" type="date" onkeydown="return false"
                            class="border p-2 rounded-lg w-full
                    @error('date') border-red-600
                    @enderror" value="{{ old('date') }}"
                    value="{{ old('date') }}">
                        @error('date')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                        @enderror
                        @if (session('message'))
                            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">
                                {{ session('message') }}</p>
                        @endif
                    </div>
                    <input id="boton" type="button" value="Crear Concierto"
                        class="bg-yellow-400 hover:bg-yellow-600 transition-all cursor-pointer uppercase font-bold text-black rounded w-full p-3">
                </form>
            </div>
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
            title: '¿Estás seguro que quieres crear un concierto con estos datos?',
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
