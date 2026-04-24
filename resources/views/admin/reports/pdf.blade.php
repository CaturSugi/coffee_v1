<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #ea580c; padding-bottom: 10px; }
        .header h1 { color: #ea580c; margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; color: #666; }
        
        .summary { margin-bottom: 30px; width: 100%; }
        .summary td { padding: 10px; background: #f9fafb; border-radius: 8px; }
        .summary .label { font-size: 10px; color: #9ca3af; text-transform: uppercase; font-weight: bold; }
        .summary .value { font-size: 16px; font-weight: bold; color: #111827; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #ea580c; color: white; padding: 10px; text-align: left; font-size: 10px; text-transform: uppercase; }
        td { padding: 10px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        .text-right { text-align: right; }
        .footer { margin-top: 50px; text-align: right; font-size: 10px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BRAN COFFEE</h1>
        <p>Laporan Penjualan Periode: {{ date('d M Y', strtotime($startDate)) }} - {{ date('d M Y', strtotime($endDate)) }}</p>
    </div>

    <table class="summary">
        <tr>
            <td width="50%">
                <div class="label">Total Pendapatan</div>
                <div class="value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </td>
            <td width="50%">
                <div class="label">Total Transaksi</div>
                <div class="value">{{ number_format($totalTransactions, 0, ',', '.') }} Transaksi</div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode & Waktu</th>
                <th width="20%">Pelanggan</th>
                <th width="15%">Metode</th>
                <th width="15%" class="text-right">Subtotal</th>
                <th width="10%" class="text-right">Diskon</th>
                <th width="15%" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <strong>#{{ $row->transaction_code }}</strong><br>
                    <small>{{ $row->created_at->format('d/m/Y H:i') }}</small>
                </td>
                <td>
                    {{ $row->member->member_name ?? 'Guest' }}<br>
                    <small>Kasir: {{ $row->user->name }}</small>
                </td>
                <td>{{ ucfirst($row->payment_method) }}</td>
                <td class="text-right">{{ number_format($row->subtotal, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($row->discount_amount, 0, ',', '.') }}</td>
                <td class="text-right"><strong>{{ number_format($row->total_amount, 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }} oleh {{ auth()->user()->name }}
    </div>
</body>
</html>
