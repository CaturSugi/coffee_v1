<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaction->transaction_code }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #ea580c;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .divider {
            border-bottom: 1px solid #eee;
            margin: 20px 0;
        }
        .info-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .info-table td {
            vertical-align: top;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table th {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .details-table td {
            border: 1px solid #eee;
            padding: 10px;
        }
        .summary-table {
            width: 100%;
            text-align: right;
        }
        .summary-table td {
            padding: 5px 10px;
        }
        .total-row {
            font-size: 16px;
            font-weight: bold;
            color: #ea580c;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 10px;
            color: #999;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-completed { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef9c3; color: #854d0e; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>BRAN COFFEE n CO</h1>
            <p>Jl. Coffee Street No. 123, Jakarta</p>
            <p>Phone: (021) 1234-5678 | Email: info@brancoffee.com</p>
        </div>

        <div class="divider"></div>

        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <strong>NO. INVOICE:</strong> #{{ $transaction->transaction_code }}<br>
                    <strong>TANGGAL:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}<br>
                    <strong>KASIR:</strong> {{ $transaction->user->name }}
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong>PELANGGAN:</strong><br>
                    {{ $transaction->member ? $transaction->member->member_name : 'Pelanggan Umum' }}<br>
                    @if($transaction->member)
                        Code: {{ $transaction->member->member_code }}
                    @endif
                </td>
            </tr>
        </table>

        <table class="details-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Produk</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Harga</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->details as $item)
                <tr>
                    <td>
                        {{ $item->product->name ?? 'Produk Tidak Ditemukan' }}
                        @if($item->notes)
                            <br><small style="color: #888;">* {{ $item->notes }}</small>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <td style="width: 70%;">Subtotal</td>
                <td style="width: 30%;">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
            </tr>
            @if($transaction->discount_amount > 0)
            <tr>
                <td>Diskon ({{ $transaction->discount_percentage }}%)</td>
                <td style="color: #ef4444;">- Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr>
                <td>PPN (10%)</td>
                <td>Rp {{ number_format($transaction->tax_amount, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>TOTAL</td>
                <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <div style="margin-top: 10px;">
            <p><strong>Metode Pembayaran:</strong> {{ strtoupper($transaction->payment_method) }}</p>
            <p><strong>Status Pembayaran:</strong> 
                <span class="status-badge {{ $transaction->payment_status === 'completed' ? 'status-completed' : 'status-pending' }}">
                    {{ $transaction->payment_status === 'completed' ? 'LUNAS' : 'PENDING' }}
                </span>
            </p>
            @if($transaction->notes)
                <p><strong>Catatan:</strong> {{ $transaction->notes }}</p>
            @endif
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja di Bran Coffee n Co!</p>
            <p>Struk ini adalah bukti pembayaran yang sah.</p>
        </div>
    </div>
</body>
</html>
