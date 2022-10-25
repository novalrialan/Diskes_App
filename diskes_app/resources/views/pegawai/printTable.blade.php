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
            background-color: #2020ff;
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

    <h2 align="center">Daftar Data Pegawai</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Sub Bagian</th>
            <th>Jabatan</th>
        </tr>
        @foreach ($pegawai as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama_pegawai }}</td>
                <td>{{ $row->subbagian->namabagian }}</td>
                <td>{{ $row->jabatan }}</td>
            </tr>
        @endforeach
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
