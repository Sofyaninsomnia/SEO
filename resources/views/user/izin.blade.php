@extends('components.layouts.user.header-content')
@section('content')
    <x-layouts.user.header></x-layouts.user.header>
    <x-layouts.user.aside></x-layouts.user.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form izin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('absen.user') }}">Absen</a></li>
                    <li class="breadcrumb-item active">Form izin</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">

                        <div class="card">
                            <h2 class="card-title">Form pengajuan izin absen</h2>
                            <div class="card-body">
                                <form id="absenForm" action="{{ route('kirim-izin') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <div class="form-group mb-2">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="" selected disabled>Opsi absen</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="file">Foto surat</label><small class="text-danger sm" style="font-size: 12px"> maximal 5mb</small>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" rows="5" placeholder="(Opsional)" class="form-control"></textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" onclick="getLocation()" class="btn btn-primary">Kirim</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="{{ route('absen.user') }}" class="btn btn-danger">Kembali</a>
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