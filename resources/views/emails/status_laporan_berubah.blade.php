<!DOCTYPE html>
<html>
<head>
    <title>Status Laporan Berubah</title>
</head>
<body>
    <p>Halo {{ $report->user->name }},</p>

    <p>Status laporan Anda telah berubah</p>
    <p>Terlapor: {{ $report->name }}</p>
    <p>Status Laporan: "{{ $statusLaporan }}"
    </p>
    <p>Respon Admin: {{ $report->respon_admin }}</p>
    
    <p>Silakan login ke sistem untuk melihat laporan lebih lanjut.</p>

    <p>Salam hormat,</p>
    <p>Admin E-Kliwas</p>
</body>
</html>
