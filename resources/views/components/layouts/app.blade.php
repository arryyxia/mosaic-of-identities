<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="viewport-fit=cover">

    @vite('resources/css/app.css')

    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body>
    <div class="p-4 w-full overflow-hidden">
        {{ $slot }}
    </div>

    <div class="dock">
        <a href="/penjual" wire:navigate class="{{ request()->is('penjual*') ? 'dock-active' : '' }}">
            <flux:icon.user-group />
            <span class="dock-label">Penjual</span>
        </a>

        <a href="/pesanan" wire:navigate class="{{ request()->is('pesanan*') ? 'dock-active' : '' }}">
            <flux:icon.banknotes />
            <span class="dock-label">Pesanan</span>
        </a>

        <a href="/produk" wire:navigate class="{{ request()->is('produk*') ? 'dock-active' : '' }}">
            <flux:icon.rectangle-stack />
            <span class="dock-label">Produk</span>
        </a>
    </div>
</body>

</html>
