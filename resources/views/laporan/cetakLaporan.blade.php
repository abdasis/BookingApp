<!DOCTYPE html>
<html>

<head>
    <title>{{ $data['title'] }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">{{ $data['title'] }}</h1>
    <p>Tanggal: {{ $data['date'] }}</p>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>EMAIL / WA</th>
                <th>JENIS KELAMIN</th>
                <th>CHECK IN</th>
                <th>CHECK OUT</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['booking'] as $key=> $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item['NamaBooking'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['Gender'] == 'L' ? 'Pria' : 'Wanita' }}</td>
                    <td>{{ $item['checkIn'] }}</td>
                    <td>{{ $item['checkOut'] }}</td>
                    <td>
                        @if ($item['Status'] == 1)
                            <span>Menunggu Pembayaran</span>
                        @elseif ($item['Status'] == 2)
                            <span>Dibayar</span>
                        @elseif ($item['Status'] == 3)
                            <span>Belum Dikonfirmasi</span>
                        @elseif ($item['Status'] == 4)
                            <span>Cancel Order</span>
                        @else
                            <span>Selesai / Telah Checkout</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
