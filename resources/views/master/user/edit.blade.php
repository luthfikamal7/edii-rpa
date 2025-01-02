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
        {{ __('Edit') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <h1 class="text-3xl mb-8">Edit {{$title}}</h1>
        <x-splade-form :default="$user" :action="route('master.user.update', $user)" class="space-y-4">
            @if(session()->get('client_id') == 0)
                <x-splade-select name="client_id" label="Client" placeholder="Pilih Client..." :options="$client" choices option-label="name" option-value="id"/>
            @endif
            <x-splade-input name="name" label="Name" />
            <x-splade-input name="email" label="Email" />
            <x-splade-input name="phone_number" label="Phone Number" />
            @if(session()->get('client_id') == 0)
                <x-splade-input type="date" name="start_active" label="Start Active" />
                <x-splade-input type="date" name="end_active" label="End Active" />
            @endif
            <x-splade-submit />
        </x-splade-form>
    </div>
</x-app-layout>