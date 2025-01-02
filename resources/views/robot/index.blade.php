<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __($title) }}
    </x-slot>
    <div class="p-4 sm:ml-48">
        @if(session()->get('client_id') == 0)
            <Link style="float: right;" href="{{ url('/robot/add') }}" class="inline-flex justify-center items-center py-2 px-5 text-base font-small text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Add
            </Link>
        @endif
        <x-splade-table :for="$robot">
            <x-splade-cell status as="$robot">
                @if ($robot->status == 1)
                    Aktif
                @elseif ($robot->status == 2)
                    Proses
                @else
                    Tidak Aktif
                @endif
            </x-splade-cell>
            <x-splade-cell log as="$robot">
                <a href="{{ url('/report/summary?filter[global]='.$robot->name) }}" class="text-indigo-600 hover:text-green-800">
                    Log Robot
                </a>
            </x-splade-cell>
            <x-splade-cell action as="$robot">

            @if ($robot->status != 0)
            <a href="{{ url('/robotPlay/'.$robot->id) }}" class="text-indigo-600 hover:text-green-800">
                    Play
                </a>
            @endif
            <x-splade-link style="margin-left: 10px;" href="{{ url('/robot/'.$robot->id) }}" class="text-indigo-600 hover:text-blue-800">
                    Edit
                </x-splade-link>
                @if(session()->get('client_id') == 0)
                    
                    <!-- <x-splade-link style="margin-left: 10px;" href="{{ url('/robot/delete/'.$robot->id) }}" class="text-red-600 hover:text-red-800" confirm="Delete Robot"
                        confirm-text="Are you sure you want to delete?"
                        confirm-button="Yes, delete data!"
                        cancel-button="No, I want to stay!">
                        Delete
                    </x-splade-link> -->
                @endif
            </x-splade-cell>
        </x-splade-table>
    </div>
    
</x-app-layout>