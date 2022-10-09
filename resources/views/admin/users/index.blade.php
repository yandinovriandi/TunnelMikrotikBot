<x-app-layout title="Users Lists">
    <x-slot name='header'>
        <div class="col-auto mb-3">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i class="fa-solid fa-people-arrows"></i></div>
                User Lists
            </h1>
        </div>
        <div class="col-12 col-xl-auto mb-3">
            <a class="btn btn-sm btn-light text-primary" href={{ route('tunnels.index') }}>
                <i class="fas fa-long-arrow-alt-left"></i> Kembali
            </a>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>>{{ $users->firstItem() + $loop->index }}<< /td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td> {{ $user->email }}</td>
                            <td>Administrator</td>
                            <td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    href="user-management-edit-user.html"><i data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i
                                        data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @pushOnce('script')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src={{ asset('js/datatables/datatables-simple-demo.js') }}></script>
    @endpushOnce
</x-app-layout>
