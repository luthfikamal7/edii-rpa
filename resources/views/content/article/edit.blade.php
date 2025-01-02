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
    <x-slot name="sublastheader">
        {{ __('Edit') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <h1 class="text-3xl mb-8">Edit {{$title}}</h1>
        <x-splade-form :default="$article" :action="route('content.article.update', $article)" class="space-y-4">
            <x-splade-input name="title" label="Title" />
            <x-splade-wysiwyg name="description" label="Description" />
            <x-splade-file name="image" filepond preview min-size="10KB" max-size="5MB" />
            <x-splade-select name="status" label="Status" :options="$list_status" choices/>
            <x-splade-submit />
        </x-splade-form>
    </div>
</x-app-layout>