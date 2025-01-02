<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __($title) }}
    </x-slot>
    <x-slot name="subheader">
        {{ __('Log') }}
    </x-slot>
    <div class="p-4 sm:ml-48">
        <x-splade-table :for="$robot">
            <x-splade-cell code as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->code }}</p>
            </x-splade-cell>
            <x-splade-cell name as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->name }}</p>
            </x-splade-cell>
            <x-splade-cell start_date as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->start_date }}</p>
            </x-splade-cell>
            <x-splade-cell end_date as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->end_date }}</p>
            </x-splade-cell>
            <x-splade-cell nomor as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->nomor }}</p>
            </x-splade-cell>
            <x-splade-cell title as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->title }}</p>
            </x-splade-cell>
            <x-splade-cell dimulai as="$robot">
                <p @if($robot->status_error == 1) class="text-red-500" @endif> {{ $robot->dimulai }}</p>
            </x-splade-cell>
            <x-splade-cell duration as="$robot">
                @php
                    $start_date = \Carbon\Carbon::parse($robot->start_date);
                    $end_date = \Carbon\Carbon::parse($robot->end_date);

                    $selisih_menit = $end_date->diffInMinutes($start_date);
                    $selisih_detik = $end_date->diffInSeconds($start_date);
                @endphp
                <p @if($robot->status_error == 1) class="text-red-500" @endif> Selisih waktu: {{ $selisih_menit }} menit, {{ $selisih_detik }} detik</p>
            </x-splade-cell>
        </x-splade-table>
    </div>
    
</x-app-layout>