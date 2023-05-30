<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    @vite('resources/css/app.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <title>Melody - @yield('title')</title>
</head>

<body class="bg-slate-500">
    <header class="p-5 bg-gray-700">
        <div class="container mx-auto flex justify-between items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="text-2xl font-black uppercase">
                    <img src="{{ asset('img/logo-Melody.jpg') }}" class="h-16 rounded">
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white font-bold uppercase hover:text-gray-400 transition-all">Cerrar Sesión</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('home') }}" class="text-2xl font-black uppercase">
                    <img src="{{ asset('img/logo-Melody.jpg') }}" class="h-16 rounded">
                </a>
                <nav class="flex flex-col gap-2 items-center">
                    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    <a href="{{ route('login') }}" class="text-white font-bold uppercase hover:text-gray-400 transition-all">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="text-white font-bold uppercase hover:text-gray-400 transition-all">Crear Cuenta</a>
                </nav>
            @endguest
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="text-white font-bold text-center text-3xl mb-10 uppercase">@yield('title-page')</h2>
        @yield('content')
    </main>
    <footer class="text-white text-center p-5 font-bold uppercase">
        Melody - Todos los derechos reservados {{ now()->year }}
    </footer>
</body>
    @yield('alerts')
    @yield('script')
</html>
