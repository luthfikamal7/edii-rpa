<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __('Master') }}
    </x-slot>
    <x-slot name="subheader">
        {{ __($title) }}
    </x-slot>
    <div class="p-4 sm:ml-48">
        <Link style="float: right;" href="{{ url('/master/work/add') }}" class="inline-flex justify-center items-center py-2 px-5 text-base font-small text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Tambah
        </Link>
        <x-splade-table :for="$works">
            <x-splade-cell status as="$work">
                @if ($work->status == 1)
                    Aktif
                @else
                    Tidak Aktif
                @endif
            </x-splade-cell>
            <x-splade-cell action as="$work">
                <x-splade-link href="{{ url('/master/work/'.$work->id) }}" class="text-indigo-600 hover:text-blue-800">
                    Edit
                </x-splade-link>
                <x-splade-link style="margin-left: 10px;" href="{{ url('/master/work/delete/'.$work->id) }}" class="text-red-600 hover:text-red-800" confirm="Delete Category Material"
                    confirm-text="Are you sure you want to delete?"
                    confirm-button="Yes, delete data!"
                    cancel-button="No, I want to stay!">
                    Delete
                </x-splade-link>
            </x-splade-cell>
        </x-splade-table>
    </div>
    
</x-app-layout>