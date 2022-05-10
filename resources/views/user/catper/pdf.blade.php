<!DOCTYPE html>
<html>

<head>
    <title>Catatan Perjalanan {{ Auth::user()->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h4>Catatan Perjalanan {{ Auth::user()->name }}</h4>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Waktu</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Suhu Tubuh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($catper as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->waktu }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->suhu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
