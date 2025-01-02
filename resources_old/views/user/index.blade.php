<x-app-layout>
    <x-slot name="header">
        {{ __('User') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <x-splade-table :for="$users">
            @cell('action', $user)
                <Link href="{{ url('/sample')."/".$user->id }}" class="font-bold text-indigo-600">
                    Edit
                </Link>
            @endcell
        </x-splade-table>
    </div>
</x-app-layout>