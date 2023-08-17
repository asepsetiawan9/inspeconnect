<!DOCTYPE html>
<html>
<head>
    <title>Status Update</title>
</head>
<body>
    <h2>Status Konsultasi: {{ $newStatus }}</h2>
    
    <p>Halo {{ $schedule->user->name }},</p>
    
    <p>Status konsultasi dengan ID {{ $schedule->id }} telah diperbarui menjadi "{{ $newStatus }}".</p>
    
    <p>Terima kasih telah menggunakan layanan kami.</p>
    
    <p>Salam,</p>
    <p>Admin E-Kliwas</p>
</body>
</html>
