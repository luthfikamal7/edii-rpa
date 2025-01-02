<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="p-4 h-full sm:ml-48">
        <div class="grid gap-6 md:grid-cols-12">
            @if(session()->get('client_id') == 0)
            <a href="#" class="col-span-2 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">1</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Total Client</span>
                    <img src="{{ asset('assets/member.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </a>
            <x-splade-link href="{{ url('/robot') }}" class="col-span-2 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $total_robot }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Total Robot</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <x-splade-link href="{{ url('/robot?filter[status]=1') }}" class="col-span-2 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $robot_aktif }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Robot Aktif</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <x-splade-link href="{{ url('/robot?filter[status]=2') }}" class="col-span-2 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $robot_proses }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Robot Proses</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <x-splade-link href="{{ url('/robot?filter[status]=0') }}" class="col-span-2 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $robot_tidak_aktif }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Robot Tidak Aktif</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <a href="#" class="col-span-2 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">2</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Total User</span>
                    <img src="{{ asset('assets/mahasiswa.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </a>
            @else
            <x-splade-link href="{{ url('/robot') }}" class="col-span-3 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $total_robot }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Total Robot</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <x-splade-link href="{{ url('/robot?filter[status]=1') }}" class="col-span-3 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $robot_aktif }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Robot Aktif</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <x-splade-link href="{{ url('/robot?filter[status]=2') }}" class="col-span-3 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $robot_proses }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Robot Proses</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            <x-splade-link href="{{ url('/robot?filter[status]=0') }}" class="col-span-3 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $robot_tidak_aktif }}</h5>
                <p class="flex items-center justify-between font-normal text-gray-700 dark:text-gray-400">
                    <span>Robot Tidak Aktif</span>
                    <img src="{{ asset('assets/member-non-registrasi.svg') }}" style="width: 50px; margin-top: -50px;">
                </p>
            </x-splade-link>
            @endif
        </div>
    </div>

</x-app-layout>