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

        <x-splade-form :action="route('master.user.save')" class="space-y-4">
            <x-splade-select name="client_id" label="Client" placeholder="Pilih Client..." :options="$list_client" choices option-label="name" option-value="id"/>
            <x-splade-input name="name" label="Name" />
            <x-splade-input name="email" label="Email" />
            <x-splade-input name="phone_number" label="Phone Number" />
            <x-splade-input type="password" name="password" label="Password" />
            @if(session()->get('client_id') == 0)
                <x-splade-input type="date" name="start_active" label="Start Active" />
                <x-splade-input type="date" name="end_active" label="End Active" />
            @endif
            
            <x-splade-submit />
        </x-splade-form>
    </div>
</x-app-layout>