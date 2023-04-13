<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style=" padding-bottom:30px" class="bg-white overflow-hidden shadow-xl sm:rounded-lg  ">
                @role('admin')
                    @livewire('admin-management-module')
                @else
                    @livewire('customer-management-module')
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
