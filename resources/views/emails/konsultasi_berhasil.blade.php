<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Konsultasi Berhasil Dibuat</title>
</head>
<body>
    <p>Halo {{ $user->name }},</p>

    <p>Jadwal konsultasi berikut ini berhasil dibuat:</p>
    <ul>
        <li>Nama: {{ $user->name }}</li>
        <li>Tanggal: {{ $schedule->date }}</li>
        <li>Waktu: {{ $schedule->time }}</li>
        <li>Tempat: {{ $schedule->place }}</li>
    </ul>

    <p>Terima kasih atas partisipasi Anda. Mohon datang tepat waktu.</p>

    <p>Salam hangat,</p>
    <p>Tim Support</p>
</body>
</html>
