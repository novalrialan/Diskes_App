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
            background-color: #e21313;
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
            background-color: #ffff;
        }

        h2 {
            font-family: arial, sans-serif;
        }
    </style>
</head>

<body>

    <h2 align="center"> Data list user</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Email</th>
            <th>Role</th>
        
        </tr>
        @foreach ($user as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->role}}</td>
            </tr>
        @endforeach

    </table>


</body>

</html>
