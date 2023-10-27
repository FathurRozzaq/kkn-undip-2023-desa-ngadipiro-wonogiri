@php
function getContentType($extension) {
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            return 'image/jpeg';
        case 'png':
            return 'image/png';
        case 'gif':
            return 'image/gif';
        case 'svg':
            return 'image/svg+xml';
        case 'pdf':
            return 'application/pdf';
        // Tambahkan jenis tipe file lainnya sesuai kebutuhan Anda
        default:
            return 'application/octet-stream'; // Tipe konten default jika tidak dikenali
    }
}
@endphp
