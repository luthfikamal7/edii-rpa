<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __($title) }}
    </x-slot>
    <x-slot name="subheader">
        {{ __('Summary') }}
    </x-slot>
    <div class="p-4 sm:ml-48">
        <x-splade-table :for="$robot">
            <x-splade-cell duration as="$robot">
                @php
                    // Mengkonversi tanggal string ke objek Carbon
                    $start_date = \Carbon\Carbon::parse($robot->start_date);
                    $end_date = \Carbon\Carbon::parse($robot->end_date);

                    // Menghitung selisih waktu dalam menit
                    $selisih_menit = $end_date->diffInMinutes($start_date);
                    $selisih_detik = $end_date->diffInSeconds($start_date);
                @endphp

                Selisih waktu: {{ $selisih_menit }} menit, {{ $selisih_detik }} detik
            </x-splade-cell>
            <x-splade-cell action as="$robot">
                <x-splade-link href="{{ url('/report/log-detail?filter[global]='.$robot->code) }}" class="text-indigo-600 hover:text-blue-800">
                    Log Detail
                </x-splade-link>
            </x-splade-cell>
        </x-splade-table>
    </div>
    
</x-app-layout>