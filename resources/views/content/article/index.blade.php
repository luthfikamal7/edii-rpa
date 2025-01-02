<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __('Content') }}
    </x-slot>
    <x-slot name="subheader">
        {{ __($title) }}
    </x-slot>
    <div class="p-4 sm:ml-48">
        <Link style="float: right;" href="{{ url('/content/article/add') }}" class="inline-flex justify-center items-center py-2 px-5 text-base font-small text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Add
        </Link>
        <x-splade-table :for="$article">
            <x-splade-cell title as="$article">
                {{ Illuminate\Support\Str::limit($article->title, 50, '...') }}
            </x-splade-cell>
            <x-splade-cell description as="$article">
                {{ Illuminate\Support\Str::limit(strip_tags($article->description), 70, '...') }}
            </x-splade-cell>
            <x-splade-cell image as="$article">
                <a target="_BLINK" href="{{ asset('storage/'.$article->image) }}" class="text-indigo-600 hover:text-blue-800">Show image</a>
            </x-splade-cell>
            <x-splade-cell status as="$article">
                @if ($article->status == 1)
                    Aktif
                @else
                    Tidak Aktif
                @endif
            </x-splade-cell>
            <x-splade-cell action as="$article">
                <x-splade-link href="{{ url('/content/article/'.$article->id) }}" class="text-indigo-600 hover:text-blue-800">
                    Edit
                </x-splade-link>
                <x-splade-link style="margin-left: 10px;" href="{{ url('/content/article/delete/'.$article->id) }}" class="text-red-600 hover:text-red-800" confirm="Delete Article"
                    confirm-text="Are you sure you want to delete?"
                    confirm-button="Yes, delete data!"
                    cancel-button="No, I want to stay!">
                    Delete
                </x-splade-link>
            </x-splade-cell>
        </x-splade-table>
    </div>
    
</x-app-layout>