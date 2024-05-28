<x-admin::layouts>
    {{-- Page Title --}}
    <x-slot:title>
        {{ $title ?? '' }}
    </x-slot>
    
    @push('styles')
        @bagistoVite(['src/Resources/assets/css/app.css'], 'rma')
    @endpush

    <!-- Page Content -->
    {{ $slot }}
</x-admin::layouts>
