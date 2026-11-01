<x-filament-panels::page>

@if(auth()->user()->role == 'admin_pusat')
    <h1 class="text-3xl font-bold">
        👑 Welcome Super Admin
    </h1>
@else
    <h1 class="text-3xl font-bold">
        🏫 Welcome {{ auth()->user()->school->name }}
    </h1>
@endif

</x-filament-panels::page>