<x-filament::widget>
    <x-filament::card>
        {{-- Tombol Reset ditampilkan di bagian header --}}
        {{ $this->headerActions }}

        {{-- Chart --}}
        {{ $this->chart }}
    </x-filament::card>
</x-filament::widget>
