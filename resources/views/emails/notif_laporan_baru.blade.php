<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Laporan Baru</title>
</head>
<body>
    <p>Halo Admin,</p>

    <p>Ada laporan baru yang telah dikirim:</p>
    <ul>
        <li>Terlapor: {{ $report->name }}</li>
        <li>Penyelesaian Laporan: {{ $report->pertemuan }}</li>
        <li>Tanggal dan Waktu: {{ $report->datetime ? $report->datetime : "-" }}</li>
        <li>Tempat Bertemu/Link Conference: {{ $report->tempat_bertemu ? $report->tempat_bertemu : "-" }}</li>
    </ul>
    
    <p>Silakan login ke sistem untuk melihat laporan lebih lanjut.</p>

    <p>Salam hormat,</p>
    <p>Admin E-Kliwas</p>
</body>
</html>
