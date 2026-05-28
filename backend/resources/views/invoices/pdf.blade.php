<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
            position: relative;
            min-height: 297mm; /* A4 */
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        /* ================= WATERMARK ================= */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 90px;
            font-weight: bold;
            text-transform: uppercase;
            white-space: nowrap;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.15;
        }

        .watermark.lunas {
            color: #2ecc71; /* hijau */
        }

        .watermark.belum-lunas {
            color: #e74c3c; /* merah */
        }

        /* ================= HEADER ================= */
        .company-logo {
            float: left;
            width: 65%;
        }

        .company-logo img {
            max-height: 80px;
        }

        .invoice-title {
            float: right;
            width: 35%;
            text-align: right;
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* ================= TOP INFO ================= */
        .top-info {
            margin-top: 20px;
        }

        .top-info table {
            width: 100%;
        }

        .top-info td {
            vertical-align: top;
            padding: 5px;
        }

        /* ================= ITEMS TABLE ================= */
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table.items th,
        table.items td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            vertical-align: middle;
        }

        table.items th {
            background-color: #3498db;
            color: white;
            text-align: center;
        }

        table.items td {
            text-align: center;
        }
        
        table.items td:first-child {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            background-color: #3498db;
            color: white;
        }

        /* ================= BANK INFO ================= */
        .bank-info {
            margin-top: 20px;
            line-height: 1.6;
        }

        /* ================= NOTES ================= */
        .notes {
            margin-top: 10px;
            font-style: italic;
        }

        /* ================= FOOTER ================= */
        .footer {
            position: fixed;
            bottom: 5mm;
            left: 0;
            width: 100%;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

    {{-- ================= WATERMARK LOGIC ================= --}}
    @php
        $isPaid = in_array($invoice->status, ['paid', 'lunas']);
    @endphp

    <div class="watermark {{ $isPaid ? 'lunas' : 'belum-lunas' }}">
        {{ $isPaid ? 'LUNAS' : 'BELUM LUNAS' }}
    </div>

    <!-- ================= HEADER ================= -->
    <div class="clearfix">
        <div class="company-logo">
            <img src="{{ public_path('logo/logo.webp') }}" alt="Company Logo" style="max-height: 90px; margin-bottom: 10px;">
            <p>
                <strong>NoFileExistsHere. | PT Teknologi Kreasi Digital</strong><br>
                Jl. Perumahan Pesona Grogol 2, Depok<br>
                info@nofileexistshere.my.id | (08) 889177045<br>
                www.nofileexistshere.my.id
            </p>
        </div>
        <div class="invoice-title">
            INVOICE
        </div>
    </div>

    <!-- ================= BILL TO ================= -->
    <div class="top-info">
        <table>
            <tr>
                <td>
                    <strong>Bill to:</strong><br>
                    {{ $invoice->client->name }}<br>
                    {{ $invoice->client->address ?? '-' }}<br>
                    {{ $invoice->client->email ?? '-' }}<br>
                    {{ $invoice->client->phone ?? '-' }}
                </td>
                <td style="text-align: right;">
                    <strong>Invoice No:</strong> {{ $invoice->invoice_number }}<br>
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->issue_date)->format('d F Y') }}<br>
                    <strong>Status:</strong> {{ strtoupper($invoice->status) }}
                </td>
            </tr>
        </table>
    </div>

    <!-- ================= ITEMS ================= -->
    <table class="items">
        <thead>
            <tr>
                <th width="40%">Description</th>
                <th width="15%">Price</th>
                <th width="10%">Qty</th>
                <th width="10%">Tax ({{ $invoice->tax > 0 ? number_format(($invoice->tax / $invoice->subtotal) * 100, 2) : '0.00' }}%)</th>
                <th width="25%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                @php
                    $qty = $item['quantity'] ?? 1;
                    $unit = $item['unit_price'] ?? $item['price'] ?? 0;
                    $itemTotal = $qty * $unit;
                @endphp
                <tr>
                    <td>
                        @if(!empty($item['item_name']) || !empty($item['name']))
                        <strong>{{ $item['item_name'] ?? $item['name'] }}</strong>
                        @endif
                        @if(!empty($item['description']))
                        <small style="font-size: 14px;">{{ $item['description'] }}</small>
                        @endif
                    </td>
                    <td class="text-right">Rp{{ number_format($unit, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $qty }}</td>
                    <td class="text-right">Rp0</td>
                    <td class="text-right">Rp{{ number_format($itemTotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @if($invoice->discount > 0)
            <tr>
                <td colspan="4" class="text-right"><strong>Discount:</strong></td>
                <td class="text-right">- Rp{{ number_format($invoice->discount, 0, ',', '.') }}</td>
            </tr>
            @endif
            @if($invoice->tax > 0)
            <tr>
                <td colspan="4" class="text-right"><strong>Tax:</strong></td>
                <td class="text-right">Rp{{ number_format($invoice->tax, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="4" class="total">Grand Total</td>
                <td class="text-right total">
                    Rp{{ number_format($invoice->total, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- ================= NOTES ================= -->
    @if($invoice->notes)
    <div class="notes">
        <p><strong>Note:</strong> {{ $invoice->notes }}</p>
    </div>
    @endif

    <!-- ================= BANK INFO ================= -->
    <div class="bank-info">
        <p><strong>Bank Account:</strong></p>
        <p>
            <strong>SeaBank</strong><br>
            90185957634 - Dwiki Arlian Maulana
        </p>
        <p>
            <strong>BCA</strong><br>
            6871791497 - Dwiki Arlian Maulana
        </p>
    </div>

    <!-- ================= FOOTER ================= -->
    <div class="footer">
        <p>If you have any questions, please contact: info@nofileexistshere.my.id</p>
    </div>

</body>
</html>
