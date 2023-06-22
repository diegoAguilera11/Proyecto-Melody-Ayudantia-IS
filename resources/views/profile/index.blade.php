@extends('layouts.app')

@section('title')
Editar Perfil
@endsection

@section('content')
    <div class="md:flex-row md:justify-center">
        <h2 class="text-center text-white uppercase font-bold text-3xl p-4">Editar Perfil</h2>
        <div class="md:mx-auto md:w-1/2 bg-gray-800 p-6 rounded-lg shadow-lg">
            <form id="form-profile" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data"
                class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-white font-bold">
                        Nombre
                    </label>
                    <input id="name" name="name" type="text" placeholder="Ingresa tu nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500
                @enderror"
                        value="{{ auth()->user()->name }}" />

                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-white font-bold">
                        Correo Electronico
                    </label>
                    <input id="email" name="email" type="text" placeholder="Ingresa tu nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500
                @enderror"
                        value="{{ auth()->user()->email }}" />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Actualizar Datos" id="confirm-button"
                    class="bg-yellow-400 hover:bg-yellow-500 transition-colors cursor-pointer uppercase font-bold text-black rounded w-full p-3" />
            </form>
        </div>
    </div>
@endsection

@section('alerts')
    <script>
        // Aqui va nuestro script de sweetalert
        const button = document.getElementById("confirm-button");
        const form = document.getElementById("form-profile");

        button.addEventListener('click', (e) => {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro que quieres enviar estos datos?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4DD091',
                cancelButtonColor: '#FF5C77',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        })
    </script>
@endsection
