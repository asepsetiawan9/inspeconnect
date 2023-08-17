<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Jadwal Konsultasi</title>
</head>
<body>
    <p>Ada jadwal konsultasi baru yang telah berhasil dibuat:</p>
    
    <ul>
        <li>Nama SKPD: {{ $user->name }}</li>
        <li>Konsultasi Via: {{ $schedule->pertemuan }}</li>
        <li>Tanggal Konsultasi: {{ $schedule->date }}</li>
        <li>Waktu: {{ $schedule->time }}</li>
        <li>Tempat/Link Pertemuan: {{ $schedule->place }}</li>
        <li>Perihal: {{ $schedule->about }}</li>
    </ul>
    
    <p>Silakan periksa dan tindak lanjuti.</p>
</body>
</html>
