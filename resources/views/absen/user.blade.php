@extends('components.layouts.user.header-content')
@section('content')
    <x-layouts.user.header></x-layouts.user.header>
    <x-layouts.user.aside></x-layouts.user.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Absen</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Super absen</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        @if (!$userAbsen)
                            <div class="col-xxl-2 col-xl-12">
                                <div class="alert alert-warning text-center"><i
                                        class="bi bi-exclamation-circle-fill"></i><span>
                                        Anda belum absen hari ini</span></div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <form id="absenForm" action="{{ route('absen.user') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <button type="button" onclick="getLocation()" class="btn btn-primary">Absen
                                        Sekarang</button>
                                </form>

                            </div>
                        @else
                            <div class="col-xxl-2 col-xl-12">
                                <div class="alert alert-success text-center">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Anda sudah absen hari ini</span>
                                </div>
                            </div>
                        @endif

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