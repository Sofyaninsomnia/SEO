<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Absen Harian</title>
    <link href="{{ asset("assets/admin/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <style>
        @media print {

            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .container {
                width: 100% !important;
                padding: 0;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin: 0;
            }

            .table th,
            .table td {
                border: 1px solid #000;
                padding: 8px;
            }

            .no-print {
                display: none !important;
            }

            h4 {
                text-align: center;
                margin-top: 20px;
                margin-bottom: 20px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h4 class="text-center mt-4">Report Absen Harian</h4>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">{{ $tanggal }}</th>
                </tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Waktu Absen</th>
                <th>Keterangan</th>
            </thead>
            <tbody>
                @forelse ($dataUserAbsen as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->waktu }}</td>
                    <td>
                        @if ($data->keterangan)
                            {{ $data->keterangan }}
                        @else
                            <h3 class="text-center">-</h3>
                        @endif
                    </td>
                    </tr>
                    @empty
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                    @endforelse
                    <tr>
                        <td colspan="5">Note: Jika nama tidak ada di list maka dinyatakan alfa</td>
                    </tr>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>