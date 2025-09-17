@extends('components.layouts.superadmin.header-content')
@section('content')
    <x-layouts.superadmin.header>
    </x-layouts.superadmin.header>
    <x-layouts.superadmin.aside></x-layouts.superadmin.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>List kas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super-kas') }}">Sistem kas</a></li>
                    <li class="breadcrumb-item active">List kas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">List kas tanggal: {{ $tanggal }}</h4>
                                    <button class="btn btn-outline-primary" style="border-radius: 50%"
                                        data-bs-toggle="modal" data-bs-target="#addModal"><i
                                            class="bi bi-plus"></i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Setoran</th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($tgl_kas->kas as $kas)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $kas->user->name }}</td>
                                                    <td>{{ 'Rp. ' . number_format($kas->setor, 0, ',', '.') }}</td>
                                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                                        <button class="btn btn-primary btn-sm"><i class="bi bi-pen"></i></button>
                                                        <form class="delete-form" action="{{ route('deleteListKas', $kas->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <p class="text-success">Total Keseluruhan : {{ 'Rp. ' .  number_format($total_kas, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('create-kas', $tgl_kas->id) }}" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Pendataan kas per individu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="username">Username</label>
                                                <select name="user_id" class="form-select">
                                                    <option value="" selected disabled>Pilih user</option>
                                                    @foreach ($user_id as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="setoran">Jumlah setor</label>
                                            <input type="number" class="form-control" name="setor"
                                                placeholder="Input minimal Rp. 1000" required>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="" method="post" accept-charset="utf-8">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Ubah list kas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="edit_user_id">Username</label>
                                                <select name="user_id" id="edit_user_id" class="form-select">
                                                    <option value="" selected disabled>Pilih user</option>
                                                    @foreach ($user_id as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="edit_setoran">Jumlah setor</label>
                                            <input type="number" id="edit_setor" class="form-control" name="setor"
                                                placeholder="Input minimal Rp. 1000" required>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const status = this.dataset.status;

                    document.getElementById('formEdit').action =
                        `/superadmin/change/data-absen/${id}`;

                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_name').value = name;
                    document.getElementById('edit_status').value = status;

                });
            });

            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
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
