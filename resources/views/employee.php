<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Management') }}
        </h2>
    </x-slot>

    <div>
        <livewire:employee />
    </div>

</x-app-layout>