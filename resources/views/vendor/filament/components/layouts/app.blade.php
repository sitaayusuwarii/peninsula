<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class([
    'dark' => filament()->hasDarkMode(),
])>
    <head>
        @filamentHead
        {{-- Tambahkan CSS custom di sini --}}
        <link rel="stylesheet" href="{{ asset('css/filament/filament/theme.css') }}">
    </head>

    <body
        class="min-h-screen font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-950"
        @if (filament()->hasSpaMode()) x-data @endif
    >
        @filamentBody
    </body>
</html>
