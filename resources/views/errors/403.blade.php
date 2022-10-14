<x-error-layout>
    <x-slot name="title">
        Error 403 Forbidden
    </x-slot>
    <img class="img-fluid p-4" src={{ asset('assets/img/illustrations/403-error-forbidden.svg') }}
        alt=" Error 403 Forbidden" />
    <p class="lead">Your client does not have permission to get this page from the server.</p>
    <a class="text-arrow-icon" href={{ route('dashboard') }}>
        <i class="ms-0 me-1" data-feather="arrow-left"></i>
        Return to Dashboard
    </a>
</x-error-layout>
