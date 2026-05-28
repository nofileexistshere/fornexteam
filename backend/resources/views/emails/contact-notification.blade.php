<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru dari Form Kontak</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            background: #2c2c2c;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .info-row {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #2c2c2c;
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .value {
            color: #333;
        }
        .message-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #2c2c2c;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 24px; font-weight: 600;">Pesan Baru dari Form Kontak</h1>
        <p style="margin: 10px 0 0; opacity: 0.8;">NoFileExistsHere. (Nexteam)</p>
    </div>
    
    <div class="content">
        <p>Halo Admin,</p>
        <p>Anda mendapat pesan baru dari form kontak website. Berikut detailnya:</p>
        
        <div class="info-row">
            <span class="label">Nama</span>
            <span class="value">{{ $contactName }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">Email</span>
            <span class="value">
                <a href="mailto:{{ $contactEmail }}" style="color: #2c2c2c; text-decoration: none;">
                    {{ $contactEmail }}
                </a>
            </span>
        </div>
        
        <div class="info-row">
            <span class="label">No. HP</span>
            <span class="value">
                <a href="tel:{{ $contactPhone }}" style="color: #2c2c2c; text-decoration: none;">
                    {{ $contactPhone }}
                </a>
            </span>
        </div>
        
        <div class="info-row">
            <span class="label">Pesan</span>
            <div class="message-box">
                {{ $contactMessage }}
            </div>
        </div>
        
        <p style="margin-top: 25px; font-size: 14px; color: #666;">
            <strong>Tips:</strong> Klik tombol "Reply" untuk langsung membalas email ini ke customer.
        </p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis dari sistem NoFileExistsHere. (Nexteam)</p>
        <p>{{ date('d F Y, H:i') }} WIB</p>
    </div>
</body>
</html>
