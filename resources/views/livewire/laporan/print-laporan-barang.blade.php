<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Daftar Barang</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Jenis Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Terima</th>
                <th>Tanggal Entry</th>
                <th>Kondisi Barang</th>
                <th>Status Barang</th>
                <th>Asal Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $index => $barang)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $barang->barang_kode ?? '-' }}</td>
                <td>{{ $barang->jenisBarang->jns_brg_nama ?? '-' }}</td>
                <td>{{ $barang->nama_barang ?? '-' }}</td>
                <td>{{ $barang->tanggal_terima ?? '-' }}</td>
                <td>{{ $barang->tanggal_entry ? \Carbon\Carbon::parse($barang->tanggal_entry)->format('Y-m-d') : '-' }}</td>
                <td>{{ $kondisiMapping[$barang->kondisi_barang] ?? '-' }}</td>
                <td>{{ $statuMapping[$barang->status_barang] ?? '-' }}</td>
                <td>{{ $barang->Asal->asal_barang ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
