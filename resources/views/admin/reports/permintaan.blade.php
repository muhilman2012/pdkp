<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Laporan Permintaan - Admin</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Laporan Permintaan</h2>
        <a href="{{ route('admin.reports.permintaan.export') }}" class="btn btn-primary mb-3">Export ke CSV</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Permintaan</th>
                    <th>Layanan</th>
                    <th>Pengguna</th>
                    <th>No Telepon</th>
                    <th>Tujuan</th>
                    <th>Waktu Permintaan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permintaan as $item)
                    <tr>
                        <td>{{ $item->id_permintaan }}</td>
                        <td>{{ $item->layanan }}</td>
                        <td>{{ $item->pengguna }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->tujuan_akhir }}</td>
                        <td>{{ $item->waktu }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>