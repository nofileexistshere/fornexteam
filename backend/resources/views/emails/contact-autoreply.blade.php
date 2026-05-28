<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih Telah Menghubungi Kami</title>
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
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .logo {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .content {
            background: #ffffff;
            padding: 40px 30px;
            border: 1px solid #e0e0e0;
            border-top: none;
        }
        .highlight-box {
            background: #f5f5f5;
            border-left: 4px solid #2c2c2c;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 5px 5px 0;
        }
        .contact-info {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            border: 1px solid #e0e0e0;
        }
        .contact-info h3 {
            margin-top: 0;
            color: #2c2c2c;
            font-size: 16px;
            font-weight: 600;
        }
        .contact-info p {
            margin: 8px 0;
        }
        .button {
            display: inline-block;
            background: #2c2c2c;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #999;
            font-size: 12px;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #2c2c2c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">NoFileExistsHere.</div>
        <p style="margin: 0; font-size: 14px; opacity: 0.8;">(Nexteam)</p>
    </div>
    
    <div class="content">
        <h2 style="color: #2c2c2c; margin-top: 0; font-weight: 600;">Halo {{ $customerName }}</h2>
        
        <p>Terima kasih telah menghubungi <strong>NoFileExistsHere. (Nexteam)</strong>!</p>
        
        <p>Kami telah menerima pesan Anda dan akan segera menghubungi Anda kembali dalam waktu <strong>1x24 jam</strong> (hari kerja).</p>
        
        <div class="highlight-box">
            <p style="margin: 0;">
                <strong>Catatan Penting:</strong><br>
                Jika Anda membutuhkan respons lebih cepat atau memiliki pertanyaan mendesak, 
                jangan ragu untuk menghubungi kami langsung melalui WhatsApp atau email.
            </p>
        </div>
        
        <div class="contact-info">
            <h3>Hubungi Kami</h3>
            <p><strong>Email:</strong> nofileexistshere@gmail.com</p>
            <p><strong>Jam Operasional:</strong><br>Senin - Jumat: 09:00 - 17:00 WIB<br>Sabtu: 09:00 - 14:00 WIB</p>
        </div>
        
        <p style="margin-top: 30px;">
            Sementara menunggu balasan dari kami, jangan ragu untuk mengunjungi website kami 
            untuk melihat portofolio dan layanan yang kami tawarkan.
        </p>
        
        <div style="text-align: center;">
            <a href="{{ config('app.url') }}" class="button">Kunjungi Website Kami</a>
        </div>
        
        <p style="margin-top: 30px; color: #666; font-size: 14px;">
            Kami sangat menghargai kepercayaan Anda dan berkomitmen untuk memberikan solusi terbaik 
            untuk kebutuhan teknologi bisnis Anda.
        </p>
        
        <div style="text-align: center; margin-top: 30px;">
            <p style="margin-bottom: 10px; color: #999; font-size: 14px;">Ikuti kami di:</p>
            <div class="social-links">
                <a href="https://www.instagram.com/nofileexistshere">Instagram</a> •
                <a href="https://www.tiktok.com/@nofileexistshere">TikTok</a> •
                <a href="https://www.linkedin.com/company/nofileexistshere">LinkedIn</a>
            </div>
        </div>
        
        <p style="text-align: center; margin-top: 40px; font-weight: 600; color: #2c2c2c;">
            Salam hangat,<br>
            Tim NoFileExistsHere. (Nexteam)
        </p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
        <p>© {{ date('Y') }} NoFileExistsHere. (Nexteam) - All Rights Reserved</p>
        <p style="margin-top: 10px; font-size: 11px;">
            Jika Anda tidak mengirim pesan ke kami, abaikan email ini.
        </p>
    </div>
</body>
</html>
