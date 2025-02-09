<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Pengembalian</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID Pengembalian</th>
                <th>ID Transaksi</th>
                <th>Peminjam</th>
                <th>Kelas</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->pengembalian_id ?? '-' }}</td>
                <td>{{ $item->peminjaman->peminjaman_id ?? '-' }}</td>
                <td>{{ $item->peminjaman->siswa->nama ?? '-' }}</td>
                <td>
                    {{ $item->peminjaman->siswa->kelas->tingkat ?? '-' }}
                    {{ $item->peminjaman->siswa->kelas->jurusan->nama_jurusan ?? '-' }}
                    {{ $item->peminjaman->siswa->kelas->no_kosentrasi ?? '-' }}
                </td>
                <td>{{ $item->tanggal_kembali ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
