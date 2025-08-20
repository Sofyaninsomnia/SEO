@extends('components.layouts.superadmin.header-content')
@section('content')
    <x-layouts.superadmin.header></x-layouts.superadmin.header>

    <x-layouts.superadmin.aside></x-layouts.superadmin.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>User list</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">User list</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">User list & permisions</h4>
                        <button class="btn btn-outline-primary" style="border-radius: 50%" data-bs-toggle="modal"
                            data-bs-target="#addModal"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="datatable">
                            <thead>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->jabatan }}</td>
                                        <td class="d-flex gap-1 align-items-center">
                                            <button class="btn btn-primary btn-sm btn-edit"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}"
                                            data-jabatan="{{ $user->jabatan }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"><i class="bi bi-pen"></i></button>
                                            <form class="delete-form" action="{{ route('hapus-user', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('add-user') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama pengguna"
                                        required>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="role">Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="" selected disabled>User role</option>
                                            @foreach ($roles as $user)
                                                <option value="{{ $user }}">{{ $user }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email pengguna" required>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="password">Password</label>
                                        <input type="text" name="password" class="form-control" placeholder="Password"
                                            required>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control"
                                            placeholder="Menjabat sebagai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="formEdit" action="" method="post" accept-charset="utf-8">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="edit_id">
                                <div class="form-group">
                                    <label for="edit_name">Username</label>
                                    <input type="text" name="name" id="edit_name" class="form-control" placeholder="Nama pengguna"
                                        required>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="edit_role">Role</label>
                                        <select name="role" id="edit_role" class="form-select" required>
                                            <option value="" selected disabled>User role</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->role }}">{{ $user->role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="edit_email">Email</label>
                                        <input type="email" name="email" id="edit_email" class="form-control"
                                            placeholder="Email pengguna" required>
                                    </div>
                                </div>
                                    <div class="form-goup">
                                        <label for="edit_jabatan">Jabatan</label>
                                        <input type="text" name="jabatan" id="edit_jabatan" class="form-control"
                                            placeholder="Menjabat sebagai" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const email = this.dataset.email;
                const role = this.dataset.role;
                const jabatan = this.dataset.jabatan;

                document.getElementById('formEdit').action = `/superadmin/change/data-user/${id}`;

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = role;
                document.getElementById('edit_jabatan').value = jabatan;

            });
        });

        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Data ini akan dihapus secara permanen!!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, saya yakin!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
    </script>
@endpush
