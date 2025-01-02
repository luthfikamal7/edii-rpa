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
    <x-slot name="sublastheader">
        {{ __('Add') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <h1 class="text-3xl mb-8">Add {{$title}}</h1>

        <x-splade-form :action="route('master.client.save')" class="space-y-4">
            <x-splade-input name="name" label="Name" />
            <x-splade-textarea name="description" label="Description" />
            <x-splade-input name="address" label="Address" />
            <x-splade-input name="phone_number" label="Phone Number" />
            <x-splade-input name="pic" label="PIC" />
            <x-splade-input name="phone_number_pic" label="Phone Number (PIC)" />
            <x-splade-input name="website" label="Website" />
            <x-splade-submit />
        </x-splade-form>
    </div>
</x-app-layout>