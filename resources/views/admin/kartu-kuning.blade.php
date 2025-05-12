<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna dengan Kartu Kuning</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Pengguna yang Sudah Membuat Kartu Kuning</h1>
    
    <table>
        <tr>
            <th>Nama Pengguna</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        @foreach($usersWithKartuKuning as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->kartu_kuning ? 'Sudah Memiliki Kartu Kuning' : 'Belum Memiliki Kartu Kuning' }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
