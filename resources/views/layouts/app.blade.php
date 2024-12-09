<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->@import 'fontawesome.css';
/* @import 'brands.css'; */
/* @import 'solid.css'; */
/* @import 'regular.css';
@import 'light.css';
@import 'thin.css';
@import 'duotone.css';
@import 'duotone-regular.css';
@import 'duotone-light.css';
@import 'duotone-thin.css';
@import 'sharp-solid.css';
/* @import 'sharp-regular.css'; */
@import 'sharp-light.css';
/* @import 'sharp-thin.css';
@import 'sharp-duotone-solid.css';
@import 'sharp-duotone-regular.css';
@import 'sharp-duotone-light.css';
@import 'sharp-duotone-thin.css'; */ 
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
