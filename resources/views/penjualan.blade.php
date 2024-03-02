<!DOCTYPE html>
<html>
    <head>
        <title>Data Penjualan</title>
    </head>
    <body>
        <h1>Data Penjualan</h1>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Kode User</th>
                <th>Pembeli</th>
                <th>kode Transaksi</th>
                <th>Tanggal Transaksi</th>
            </tr>
            @foreach ($data as $d)
                <tr>
                    <td>{{$d->penjualan_id}}</td>
                    <td>{{$d->user_id}}</td>
                    <td>{{$d->pembeli}}</td>
                    <td>{{$d->penjualan_kode}}</td>
                    <td>{{$d->penjualan_tanggal}}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>