<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __($title) }}
    </x-slot>
    <x-slot name="subheader">
        {{ __('Edit') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <h1 class="text-3xl mb-8">Edit {{$title}}</h1>
        <x-splade-form :default="$robot" :action="route('robot.update', $robot)" class="space-y-4">
            <x-splade-input name="name" label="Name" />
            <x-splade-input name="description" label="Description" />
            <!-- <x-splade-input name="workflow_id" label="Workflow ID" readonly /> -->
            <x-splade-select name="status" label="Status" :options="$list_status" choices/>
            <x-splade-submit />
        </x-splade-form>
    </div>
</x-app-layout>