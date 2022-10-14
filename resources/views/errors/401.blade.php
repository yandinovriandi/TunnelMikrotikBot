 <x-error-layout>
     <x-slot name="title">
         Error 401 Unauthorized
     </x-slot>
     <img class="img-fluid p-4" src={{ asset('assets/img/illustrations/401-error-unauthorized.svg') }}
         alt="Error 401 Unauthorized" />
     <p class="lead">Access to this resource is denied.</p>
     <a class="text-arrow-icon" href={{ route('dashboard') }}>
         <i class="ms-0 me-1" data-feather="arrow-left"></i>
         Return to Dashboard
     </a>
 </x-error-layout>
