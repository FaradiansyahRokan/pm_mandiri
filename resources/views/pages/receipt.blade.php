<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .header h2 {
            margin: 0;
        }
        .header h3 {
            margin-top: 0;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tfoot td {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Peti Ngemil</h2>
            <h3>RECEIPT</h3>
        </div>
        <div class="details">
            <p><strong>Diterbitkan Oleh:</strong> Peti Ngemil</p>
            <p><strong>Pembeli:</strong>{{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Pesanan</th>
                    <th>Harga Barang</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->transactionItems as $item)
                <tr>
                    <td>{{ $item->product->id }}</td>
                    <td>{{ $item->product->name_product }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>RP {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>RP {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">ONGKIR</td>
                    <td>{{ number_format($transaction->ongkir, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4">TOTAL</td>
                    <td>RP {{ number_format($transaction->total_price, 0, ',', '.') }}</td>

                </tr>
            </tfoot>
        </table>
        <div class="details">
            <p><strong>Alamat Pembeli:</strong></p>
            <p>{{ $address->city }}, {{ $address->province }}, {{ $address->district }}, {{ $address->detail }}, {{ $transaction->address_type }}</p>
            <p>{{ $transaction->user->phone_number}}</p>
        </div>
        <div class="details">
            <p><strong>Notes Pembeli:</strong></p>
            <p>{{$transaction->notes}}.</p>
        </div>
    </div>
</body>
</html>
