<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('chart')
    @stack('sweetAlert')
    <title>Melody - @yield('title')</title>
</head>

<body class="bg-slate-500">
    <header class="p-5 bg-gray-700">
        <div class="container mx-auto flex justify-between items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="text-2xl font-black uppercase">
                    <img src="{{ asset('img/logo-Melody.jpg') }}" class="h-12 md:h-16 rounded">
                </a>
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                    class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white rounded md:border-0 text-xl md:hover:text-red-400 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                    {{ auth()->user()->name }}
                    <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownNavbar"
                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-88 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">

                        <li class="mb-4">
                            <a class="w-full p-2 hover:bg-slate-300 hover:rounded-lg font-bold uppercase text-center cursor-pointer"
                                href="{{ route('profile.index') }}">Cambiar Contraseña</a>
                        </li>
                        <li class="my-4">
                            <a class="p-2 hover:bg-slate-300 hover:rounded-lg font-bold uppercase text-center cursor-pointer"
                                href="{{ route('profile.index') }}">Editar Perfil</a>
                        </li>
                        <li class="mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-2 font-bold uppercase hover:bg-slate-300 hover:rounded-lg">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
            @guest
                <a href="{{ route('home') }}" class="text-2xl font-black uppercase">
                    <img src="{{ asset('img/logo-Melody.jpg') }}" class="h-16 rounded">
                </a>
                <nav class="flex flex-col gap-2 items-center">
                    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    <a href="{{ route('login') }}"
                        class="text-white font-bold uppercase hover:text-gray-400 transition-all">Iniciar Sesión</a>
                    <a href="{{ route('register') }}"
                        class="text-white font-bold uppercase hover:text-gray-400 transition-all">Crear Cuenta</a>
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
