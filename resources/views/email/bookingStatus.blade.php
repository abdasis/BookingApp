<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Email</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            line-height: 1.2; /* tambahkan ini untuk membuat font lebih rapat */
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px; /* tambahkan ini untuk membuat konten lebih rapat */
        }
        .header {
            background-color: #008080; /* Primary Teal Color */
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h2{
            color: white;
        }
        .content {
            padding: 0; /* hapus padding untuk membuat konten lebih rapat */
        }
        h2, h3 {
            color: #008080;
        }
        p {
            margin-bottom: 10px; /* tambahkan ini untuk membuat paragraf lebih rapat */
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            margin-bottom: 10px; /* tambahkan ini untuk membuat grid lebih rapat */
        }
        .grid div {
            padding: 2px;
            border-bottom: 0;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
        }
        @media (max-width: 600px) {
           /* .grid {
                grid-template-columns: 1fr;
            }*/
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Terima kasih telah melakukan booking di Basecamp Military Lifestyle</h2>
        </div>
        <div class="content">
            <p>Hai, {{ $user['name'] ?? 'Tamu' }}!</p>
            @if($booking['wahana_id'] != null)
              <p>Terima kasih telah mempercayakan kami sebagai tempat bermain wahana air. Berikut adalah detail booking Kamu:</p>
            @else
              <p>Terima kasih telah mempercayakan kami sebagai tempat menginap Kamu. Berikut adalah detail booking Kamu:</p>
            @endif

            <h3>Detail Booking</h3>
           @if ($booking['wahana_id'] != null)
              <div class="grid">
                <div>Nama:</div><div>{{ $user['name'] ?? 'Tamu' }}</div>
                <div>Email:</div><div>{{ $user['email'] }}</div>
                <div>Nomor Telepon:</div><div>{{ $booking['telepon'] ?? 'Tidak Diketahui' }}</div>
                <div>Wahana:</div><div>{{ $wahana->nama }}</div>
                <div>Harga Tiket:</div><div>{{ rupiah($booking['total']) }}</div>
                <div>Diskon:</div><div>{{ rupiah($booking['jumlah_discount']) }}</div>
                <div>Total:</div><div>{{ rupiah($booking['grand_total']) }}</div>
            </div>
           @else
              <div class="grid">
                <div>Nama:</div><div>{{ $booking['NamaBooking'] ?? 'Tamu' }}</div>
                <div>Email:</div><div>{{ $user['email'] }}</div>
                <div>Nomor Telepon:</div><div>{{ $booking['hp'] ?? 'Tidak Diketahui' }}</div>
                <div>Nama Kamar:</div><div>{{ $booking['NamaRoom'] ?? 'Tidak Diketahui' }}</div>
                <div>Jumlah Kamar:</div><div>1</div>
                <div>Tanggal Check-in:</div><div>{{ $booking['checkIn'] ?? 'Tidak Diketahui' }}</div>
                <div>Tanggal Check-out:</div><div>{{ $booking['checkOut'] ?? 'Tidak Diketahui' }}</div>
                <div>Status:</div><div>{{ $booking['Status'] == '1' ? 'Menunggu Pembayaran' : ($booking['Status'] == '2' ? 'Dibayar' : ($booking['Status'] == '3' ? 'Menunggu Konfirmasi' : 'Order Dibatalkan')) }}</div>
                <div>Harga:</div><div>Rp. {{ rupiah($booking['total'] ?? 0) }}</div>
                <div>Diskon:</div><div>Rp. {{  rupiah($booking['discount'] ?? 0) }}</div>
                <div>Grand Total:</div><div>Rp. {{  rupiah($booking['grand_total'] ?? 0) }}</div>
            </div>
           @endif

           <h3>Informasi Akun</h3>
            <p>Kamu dapat mengakses sistem kami menggunakan detail berikut:</p>
            <p><strong>Username:</strong> {{ $user['email'] }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
            <p>Pastikan untuk mengubah password Kamu setelah login pertama untuk keamanan akun Kamu.</p>

            <p>Jika Kamu memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.</p>
        </div>
        <div class="footer">
            <p>Salam Hangat,</p>
            <p><strong>Basecamp Military Lifestyle</strong></p>
        </div>
    </div>
</body>
</html>
