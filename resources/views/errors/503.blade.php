<x-error-layout>
    <x-slot name="title">
        Error 503 Service Unavailable
    </x-slot>
    <img class="img-fluid p-4" src={{ asset('assets/img/illustrations/503-error-service-unavailable.svg') }}
        alt="Error 503 Service Unavailable" />
    <p class="lead">The server is temporarily unable to service your request due to maintenance downtime or capacity
        problems. Please try again later.</p>
    <a class="text-arrow-icon" href={{ route('dashboard') }}>
        <i class="ms-0 me-1" data-feather="arrow-left"></i>
        Return to Dashboard
    </a>
</x-error-layout>
