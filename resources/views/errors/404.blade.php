<x-error-layout>
    <x-slot name="title">
        Error 404 Not Found
    </x-slot>
    <img class="img-fluid p-4" src={{ asset('assets/img/illustrations/404-error.svg') }} alt="Error 404 Not Found" />
    <p class="lead">This requested URL was not found on this server.</p>
    <a class="text-arrow-icon" href={{ route('dashboard') }}>
        <i class="ms-0 me-1" data-feather="arrow-left"></i>
        Return to Dashboard
    </a>
</x-error-layout>
