<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            padding: 20px;
        }

        th {
            background-color: #2f2d2d;
            color: #ffff;
            padding-top: 10px;
        }

        td,
        th {
            border: 1px solid #ede7e7;
            text-align: left;
            padding: 8px;
            background-color: #ddddd;
        }

        tr:nth-child(even) {
            background-color: #fffff;
        }

        h2 {
            font-family: arial, sans-serif;
        }
    </style>
</head>

<body>

    <h2 align="center">Daftar Data Verifikasi</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Title</th>
            <th>Keterangan</th>
            <th>File</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
        @foreach ($verifikasi as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->berkas->pegawai->nama_pegawai }}</td>
                <td>{{ $row->berkas->title }}</td>
                <td>{{ $row->berkas->keterangan }}</td>
                <td><i class="fa fa-file-pdf-o"> {{ $row->berkas->file }}</i></td>
                <td>{{ $row->tanggal_verifikasi }}</td>
                <td> <span class="label {{ $row->status == 0 ? 'label-danger' : 'label-success' }}">
                        {{ $row->status == 0 ? 'belum terverifikasi' : 'terverifikasi' }}</span>
                </td>
            </tr>
        @endforeach

    </table>

    <script>
        window.print();
    </script>

</body>

</html>
