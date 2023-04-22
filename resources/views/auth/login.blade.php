@extends('layouts.app')
@section('title')
    Iniciar Sesión
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-gray-800 p-6 rounded-lg shadow-lg">

            <h2 class="text-center text-white uppercase font-bold text-3xl p-4">Inicia Sesión en Melody</h2>
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ session('message') }}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-white font-bold">
                        Correo Electrónico
                    </label>
                    <input id="email" name="email" placeholder="correo@correo.com"
                        class="border p-2 rounded-lg w-full
                @error('email') border-red-600
                @enderror">
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

                <input type="submit" value="Registrar"
                    class="bg-yellow-400 hover:bg-yellow-500 transition-colors cursor-pointer uppercase font-bold text-black rounded w-full p-3">
            </form>
        </div>
    </div>
@endsection
