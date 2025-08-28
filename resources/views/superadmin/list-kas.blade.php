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
                        <button class="btn btn-outline-primary" style="border-radius: 50%" data-bs-toggle="modal"
                            data-bs-target="#addModal"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="datatable">
                            <thead>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
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
