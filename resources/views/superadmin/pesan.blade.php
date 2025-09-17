@extends('components.layouts.superadmin.header-content')
@section('content')
    <x-layouts.superadmin.header>
    </x-layouts.superadmin.header>
    <x-layouts.superadmin.aside></x-layouts.superadmin.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pesan Saran Fitur</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pesan Saran Fitur</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Daftar Pesan</h3>
                            <div class="table-responsive">
                                <table class="datatable">
                                    <thead>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @if ($pesan)
                                            @foreach ($pesan as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->user->name }}</td>
                                                    <td class="d-flex gap-2">
                                                        <a href="{{ route('feedback', $data->id) }}"
                                                            class="btn btn-success"><i class="bi bi-chat-fill"></i></a>
                                                            <form class="delete-form" action="{{ route('super.delete_chat', $data->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                            </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="{{ asset('assets/image/404.jpg') }}" alt=""
                                                    class="img-fluid" width="500px">
                                            </div>
                                        @endif
                                    </tbody>
                                </table>
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
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            document.getElementById('absenForm').submit();
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Pengguna menolak permintaan Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan untuk mendapatkan lokasi pengguna habis waktu.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        }
    </script>
@endpush
