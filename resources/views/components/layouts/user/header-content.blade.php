<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>user - SEO</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <link href="{{ asset("assets/landing/img/logo-kelas.png")}}" rel="icon">
  <link href="{{ asset("assets/landing/img/logo-kelas.png")}}" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset("assets/admin/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/vendor/quill/quill.snow.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/vendor/quill/quill.bubble.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/vendor/remixicon/remixicon.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/vendor/simple-datatables/style.css")}}" rel="stylesheet">
  <link href="{{ asset("assets/admin/css/custom.css")}}" rel="stylesheet">

  <link href="{{ asset("assets/admin/css/style.css")}}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">


  </head><body>

  @yield('content')

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Symphony</span> </strong>2025. All Rights Reserved
      <p class="timestamp">WAKTU AKSES: <span id="current-time"></span></p>
    </div>
  </footer><a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset("assets/admin/vendor/apexcharts/apexcharts.min.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/chart.js/chart.umd.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/echarts/echarts.min.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/quill/quill.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/simple-datatables/simple-datatables.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/tinymce/tinymce.min.js")}}"></script>
  <script src="{{ asset("assets/admin/vendor/php-email-form/validate.js")}}"></script>

  <script src="{{ asset("assets/admin/js/main.js")}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

  {{-- Script untuk menampilkan SweetAlert --}}
  <script>
    function updateTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', options);
        }
        setInterval(updateTime, 1000);
        updateTime(); // Initial call
  </script>
  <script>
        $(document).ready(function() {
            // Cek apakah ada pesan 'success' dari session
            @if (session('success'))
                Swal.fire({
                    title: 'Login Sukses!',
                    text: '{{ session('success') }}',
                    html: `
                        <img src="https://media.giphy.com/media/v1.Y2lkPWVjZjA1ZTQ3a3lobjFyYnIwbHgybG42bzQwMTJvZDFzZXhqeDJjbHBwczdkc3gzMyZlcD12MV9zdGlja2Vyc19zZWFyY2gmY3Q9cw/AQmRoVFBa1DDQeXprE/giphy.gif" 
                            width="140" style="border-radius: 10px;" alt="Success">
                        <p style="margin-top: 10px;">{{ session('success') }} 🎉</p>
                    `,
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('sukses'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('sukses') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    title: 'Kesalahan!',
                    html: '@foreach ($errors->all() as $error) {{ $error }}<br> @endforeach',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <script>
        $(document).ready(function() {
            document.getElementById('logout-button').addEventListener('submit', function(e) {
                e.preventDefault();

                var form = this;

                Swal.fire({
                    title: 'Yakin ingin logout?',
                    html: `
                    <img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExdjF6bDRkN3UzZjB1MzM2bHd5eDFhMmdmOWVsd20zNWE4eGt2NmVubCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/5xqyWhU3zZ0qZ6C6di/giphy.gif"
                    width="140"
                    style="border-radius: 10px;"
                    alt="Logout GIF">
                    <p style="margin-top: 10px;">Bener mau keluar? 🥲</p>`,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

  @stack('scripts')

</body>
</html>