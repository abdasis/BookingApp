<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Booking Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #4CAF50;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .header h2 {
            margin: 0;
        }

        .content {
            margin: 20px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background: #4CAF50;
            color: #fff;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Terima kasih telah melakukan booking di Basecamp Military Lifestyle</h2>
        </div>
        <div class="content">
            <p>Hai, {{ $booking['NamaBooking'] ?? 'Tamu' }}!</p>
            <p>Terima kasih telah mempercayakan kami sebagai tempat menginap Anda. Booking Anda telah
                <strong>berhasil</strong>. Berikut adalah detail booking Anda:
            </p>

            <h3>Detail Booking</h3>
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>{{ $booking['NamaBooking'] ?? 'Tamu' }}</td>
                </tr>
                <tr>
                    <th>Email / Password</th>
                    <td>{{ $booking['email'] }} /
                        <b>{{ \Carbon\Carbon::parse($booking['Created_at'])->format('dmY') }}</b>
                    </td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $booking['hp'] ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>Nama Kamar</th>
                    <td>{{ $booking->roomtypes['nama'] ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Kamar</th>
                    <td>1</td>
                </tr>
                <tr>
                    <th>Tanggal Check-in</th>
                    <td>{{ $booking['checkIn'] ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Check-out</th>
                    <td>{{ $booking['checkOut'] ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>Total Tarif</th>
                    <td>Rp. {{ number_format($booking['Total'], 0, ',', '.') ?? '0' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $booking['Status'] == '1' ? 'Menunggu Pembayaran' : ($booking['Status'] == '2' ? 'Dibayar' : ($booking['Status'] == '3' ? 'Menunggu Konfirmasi' : 'Order Dibatalkan')) }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Salam Hangat,</p>
            <p><strong>Basecamp Military Lifestyle</strong></p>
        </div>
    </div>
</body>

</html>
