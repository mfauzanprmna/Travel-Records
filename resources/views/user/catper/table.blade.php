<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <style>
            table {
                text-align: center;
                width: 100%;
            }

            .title {
                font-size: 24px;
            }

            th {
                text-align: center;
                background-color: #7a74fc;
            }

        </style>
    </head>

    <body>
        <table>
            <tr>
                <th colspan="5" style="text-align: center; font-size: 16px; font-weight: bold">Catatan Perjalanan
                    {{ Auth::user()->name }}</th>
            </tr>
            <tr>
                <th scope="col"
                    style="background: #7a74fc; color: white; text-align: center; font-size: 13px; font-weight: bold">No
                </th>
                <th scope="col"
                    style="background: #7a74fc; color: white; text-align: center; font-size: 13px; font-weight: bold">
                    Tanggal</th>
                <th scope="col"
                    style="background: #7a74fc; color: white; text-align: center; font-size: 13px; font-weight: bold">
                    Waktu</th>
                <th scope="col"
                    style="background: #7a74fc; color: white; text-align: center; font-size: 13px; font-weight: bold">
                    Lokasi</th>
                <th scope="col"
                    style="background: #7a74fc; color: white; text-align: center; font-size: 13px; font-weight: bold; grid-auto-columns: auto;">
                    Suhu Tubuh</th>
            </tr>
            @foreach ($catpers as $item)
                <tr>
                    <td style="text-align: center; font-size: 11px">{{ $loop->iteration }}</td>
                    <td style="text-align: center; font-size: 11px">{{ $item->tanggal }}</td>
                    <td style="text-align: center; font-size: 11px">{{ $item->waktu }}</td>
                    <td style="text-align: center; font-size: 11px">{{ $item->lokasi }}</td>
                    <td style="text-align: center; font-size: 11px">{{ $item->suhu }} &#8451;</td>
                </tr>
            @endforeach
        </table>
    </body>

    </html>
