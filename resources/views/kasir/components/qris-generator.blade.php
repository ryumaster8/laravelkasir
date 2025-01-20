@php
// Generate QR code using a package or service
$qr = QrCode::size(300)
           ->format('png')
           ->generate("00020101021226660014ID.LINKAJA.WWW011893600911002350020210303152112285204
           5000.005802ID5909LinkAja6007Jakarta610612340662070703A016304E437");

// Save to public directory
file_put_contents(public_path('images/qr/qris-example.png'), $qr);
@endphp
