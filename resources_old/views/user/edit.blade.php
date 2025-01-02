<x-app-layout>
    <x-slot name="header">
        {{ __('User') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <h1 class="text-3xl mb-8">Edit User {{ $user->name }}</h1>

        <x-splade-form :default="$user" :action="route('sample.update', $user)" class="space-y-4">
            <x-splade-input name="name" label="Name" />
            <x-splade-input name="email" label="Email" />
            <x-splade-select name="status" label="Status" :options="$list_status" choices/>
            <x-splade-submit />
        </x-splade-form>
    </div>
</x-app-layout>