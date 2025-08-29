@extends('components.layouts.superadmin.header-content')
@section('content')
    <x-layouts.superadmin.header>
    </x-layouts.superadmin.header>
    <x-layouts.superadmin.aside></x-layouts.superadmin.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sistem kas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Sistem kas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class=" d-flex justify-content-between align-items-center mt-3">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus"></i> Tambah</button>
                                    <h5 class="text-center card-title">Tabel data kas</h5>
                                    <button class="btn btn-outline-danger"><i class="bi bi-wallet2"></i> Pengeluaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Tanggal kas</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="datatable">
                                        <thead>
                                            <th>No</th>
                                            <th class="text-center">Tanggal</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($d->tgl)->translatedFormat('l, d F Y') }}
                                                    </td>
                                                    <td class="d-flex gap-2"><a href="{{ route('list-kas', $d->id) }}"
                                                            class="btn btn-warning btn-sm"><i class="bi bi-eye"></i></a>
                                                        <form class="delete-form" action="{{ route('deleteTgl', $d->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"><i
                                                                    class="bi bi-trash"></i></button>
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

                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('add-tgl') }}" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Input tanggal kas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="edit_name">Tanggal</label>
                                                <input type="date" name="tgl" class="form-control"
                                                    placeholder="Nama pengguna" required>
                                            </div>
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
