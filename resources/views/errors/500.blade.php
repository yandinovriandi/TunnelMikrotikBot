<x-error-layout>
    <x-slot name="title">
        Error 500 Server Error
    </x-slot>
    <img class="img-fluid p-4" src={{ asset('assets/img/illustrations/500-internal-server-error.svg') }}
        alt="Error 500 Server Error" />
    <p class="lead">The server encountered an internal error or misconfiguration and was unable to complete your
        request.</p>
    <a class="text-arrow-icon" href={{ route('dashboard') }}>
        <i class="ms-0 me-1" data-feather="arrow-left"></i>
        Return to Dashboard
    </a>
</x-error-layout>
