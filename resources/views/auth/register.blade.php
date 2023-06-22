@extends('layouts.app')
@section('title')
    Registrar Cliente
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-gray-800 p-6 rounded-lg shadow-lg">

            <h2 class="text-center text-white uppercase font-bold text-3xl p-4">Registrate en Melody</h2>
            <form id="formulario" action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-white font-bold">
                        Nombre
                    </label>
                    <input id="name" name="name" placeholder="Ingresa tu nombre"
                        class="border p-2 rounded-lg w-full
                @error('name')
                    border-red-600
                @enderror"
                value="{{ old('name') }}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-white font-bold">
                        Correo Electrónico
                    </label>
                    <input id="email" name="email" placeholder="correo@correo.com"
                        class="border p-2 rounded-lg w-full
                @error('email') border-red-600
                @enderror"
                value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-white font-bold">
                        Contraseña
                    </label>
                    <input id="password" name="password" type="password"
                        class="border p-2 rounded-lg w-full
                @error('password') border-red-600
                @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <input id="boton" type="button" value="Registrar"
                    class="bg-yellow-400 hover:bg-yellow-500 transition-colors cursor-pointer uppercase font-bold text-black rounded w-full p-3">
            </form>
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

