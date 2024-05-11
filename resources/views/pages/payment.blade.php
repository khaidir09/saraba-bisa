<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Perpanjang Langganan</title>

        {{-- Fav Icon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @stack('styles')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="font-inter antialiased bg-slate-100 text-slate-600"
    >

        <!-- Page wrapper -->
        <div class="flex h-screen overflow-hidden">

            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden bg-white" x-ref="contentarea">

                <header class="sticky top-0 bg-white border-b border-slate-200 z-30">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-16 -mb-px">

                            <!-- Header: Left side -->
                            <div class="flex">
                            </div>

                            <!-- Header: Right side -->
                            <div class="flex items-center space-x-3">

                                <!-- Notifications button -->
                                {{-- <x-dropdown-notifications align="right" /> --}}

                                <!-- Info button -->
                                {{-- <x-dropdown-help align="right" /> --}}
                                <x-exp-date align="right" />

                                <!-- Divider -->
                                <hr class="w-px h-6 bg-slate-200" />

                                <!-- User button -->
                                <x-dropdown-profile align="right" />

                            </div>

                        </div>
                    </div>
                </header>

                <main>
                    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

                        <!-- Page header -->
                        <div class="sm:flex sm:justify-between sm:items-center mb-8">
                        
                            <!-- Left: Title -->
                            <div class="mb-4 sm:mb-0">
                                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Berlangganan ✨</h1>
                            </div>
                        
                        </div>

                        <div class="border-t border-slate-200">
                            <div class="max-w-2xl m-auto mt-16">

                                <div class="text-center px-4">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-t from-slate-200 to-slate-100 mb-4">
                                        <svg class="w-5 h-6 fill-current" viewBox="0 0 20 24">
                                            <path class="text-slate-500" d="M10 10.562l9-5-8.514-4.73a1 1 0 00-.972 0L1 5.562l9 5z" />
                                            <path class="text-slate-300" d="M9 12.294l-9-5v10.412a1 1 0 00.514.874L9 23.294v-11z" />
                                            <path class="text-slate-400" d="M11 12.294v11l8.486-4.714a1 1 0 00.514-.874V7.295l-9 4.999z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-2xl text-slate-800 font-bold mb-2">Silahkan bayar biaya perpanjang langganan</h2>
                                    <div class="mb-6">Mohon maaf, masa berlangganan kamu sudah berakhir pada <span class="text-rose-700 font-semibold">{{ \Carbon\Carbon::parse($user->exp_date)->format('d/m/Y') }}</span> sehingga akses kamu untuk sementara terkunci.</div>
                                    <a href="https://api.whatsapp.com/send?phone=62811801799&text=" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                            <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
                                        </svg>
                                        <span class="ml-2">Perpanjang Langganan</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </main>

            </div>

        </div>

        @stack('scripts')
    </body>
</html>