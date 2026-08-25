<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    @section('sidebar')
        @include('layouts.sidebar.sidebar-admin')
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Halo, {{ auth()->user()->name }} 👋 Kamu login sebagai <strong>Admin</strong>.</p>
                <p class="mt-2 text-sm text-gray-500">Ini halaman placeholder -- nanti diisi ringkasan jumlah user, instansi, evaluasi berjalan, dst.</p>
            </div>
        </div>
    </div>
</x-app-layout>
