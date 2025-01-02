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
        {{ __('Access') }}
    </x-slot>

    <div class="p-4 sm:ml-48">
        <h1 class="text-3xl mb-8">{{$title}} Akses Robot</h1>
        <x-splade-form :default="$user" :action="route('master.client.update', $user)" class="space-y-4">
            <x-splade-input name="name" label="Name" class="col-span-6" readonly/>
        </x-splade-form>
        <br>
        <br>
        <hr>
        <br>
        <form action="{{ url('/') }}/master/user/updateStatus" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-12">
                @foreach($robot as $q)
                    <div class="col-span-6">
                        <label for="robot_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Robot</label>
                        <input type="hidden" id="robot_id" name="robot_id[]" value="{{$q->id}}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <input type="text" id="robot_name" name="robot_name[]" value="{{$q->name}}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div class="col-span-6">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Status</option>
                            <option value="1" @if($q->status_robot == 1) selected @endif>Ya</option>
                            <option value="0" @if($q->status_robot == 0) selected @endif>Tidak</option>
                        </select>
                    </div>
                @endforeach
            </div>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit
            </button>
        </form>
    </div>
</x-app-layout>