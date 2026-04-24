<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class PrinterService
{
    /**
     * Print invoice via thermal printer
     */
    public function printThermal(Transaction $transaction, $printerIP = null, $port = 9100)
    {
        try {
            $printerIP = $printerIP ?? config('settings.thermal_printer_ip', '192.168.1.100');
            
            $receiptText = $this->generateReceiptText($transaction);
            
            // Connect to thermal printer via TCP socket
            $socket = fsockopen($printerIP, $port, $errno, $errstr, 5);
            
            if (!$socket) {
                throw new Exception("Tidak bisa terhubung ke printer: $errstr");
            }

            // Send receipt to printer
            fwrite($socket, $receiptText);
            fclose($socket);

            // Log successful print
            $this->logPrint($transaction, 'thermal');

            return [
                'success' => true,
                'message' => 'Invoice berhasil dicetak ke printer thermal',
            ];
        } catch (Exception $e) {
            Log::error('Thermal Printer Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Gagal mencetak ke printer thermal: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Print invoice via Bluetooth printer
     */
    public function printBluetooth(Transaction $transaction, $bluetoothDevice = null)
    {
        try {
            $bluetoothDevice = $bluetoothDevice ?? config('settings.bluetooth_device', '');
            
            $receiptText = $this->generateReceiptText($transaction);
            
            // For JavaScript/frontend implementation
            // This stores data for front-end to handle Bluetooth printing
            $this->storeBluethoothPrintData($transaction, $receiptText);

            // Log successful print request
            $this->logPrint($transaction, 'bluetooth');

            return [
                'success' => true,
                'message' => 'Invoice siap untuk dicetak via Bluetooth',
                'print_data' => base64_encode($receiptText),
            ];
        } catch (Exception $e) {
            Log::error('Bluetooth Printer Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Gagal memproses Bluetooth printing: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Generate PDF invoice
     */
    public function generatePDF(Transaction $transaction)
    {
        try {
            $pdf = Pdf::loadView('pdf.invoice', compact('transaction'));
            
            // Log successful PDF generation
            $this->logPrint($transaction, 'pdf');

            return $pdf->output();
        } catch (Exception $e) {
            Log::error('PDF Generation Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate receipt text for thermal printer
     */
    private function generateReceiptText(Transaction $transaction)
    {
        $width = 32; // Character width for 80mm thermal printer
        $receipt = '';

        // Header
        $receipt .= $this->centerText('BRAN COFFEE n CO', $width) . "\n";
        $receipt .= $this->centerText('Jl. Coffee Street No. 123', $width) . "\n";
        $receipt .= $this->centerText('Jakarta - Indonesia', $width) . "\n";
        $receipt .= str_repeat('-', $width) . "\n\n";

        // Invoice info
        $receipt .= "No: " . $transaction->transaction_code . "\n";
        $receipt .= "Tanggal: " . $transaction->created_at->format('d/m/Y H:i') . "\n";
        
        if ($transaction->member) {
            $receipt .= "Member: " . $transaction->member->member_name . "\n";
            $receipt .= "Code: " . $transaction->member->member_code . "\n";
        }
        
        $receipt .= str_repeat('-', $width) . "\n\n";

        // Items
        $receipt .= "ITEM" . str_repeat(' ', 14) . "QTY  TOTAL\n";
        $receipt .= str_repeat('-', $width) . "\n";

        foreach ($transaction->details as $detail) {
            $name = substr($detail->product->name, 0, 20);
            $qty = $detail->quantity;
            $total = number_format($detail->subtotal, 0, ',', '.');
            
            $receipt .= $name . "\n";
            $receipt .= "                  " . str_pad($qty, 3, ' ', STR_PAD_LEFT) . "  " . $total . "\n";
        }

        $receipt .= str_repeat('-', $width) . "\n";

        // Summary
        $subtotal = number_format($transaction->subtotal, 0, ',', '.');
        $receipt .= $this->rightAlign("Subtotal: Rp " . $subtotal, $width) . "\n";

        if ($transaction->discount_amount > 0) {
            $discount = number_format($transaction->discount_amount, 0, ',', '.');
            $receipt .= $this->rightAlign("Diskon: - Rp " . $discount, $width) . "\n";
        }

        $tax = number_format($transaction->tax_amount, 0, ',', '.');
        $receipt .= $this->rightAlign("PPN 10%: Rp " . $tax, $width) . "\n";

        $receipt .= str_repeat('=', $width) . "\n";
        $total = number_format($transaction->total_amount, 0, ',', '.');
        $receipt .= $this->rightAlign("TOTAL: Rp " . $total, $width) . "\n";
        $receipt .= str_repeat('=', $width) . "\n\n";

        // Payment info
        $receipt .= "Metode: " . $transaction->payment_method_label . "\n";
        $receipt .= "Status: " . strtoupper($transaction->payment_status) . "\n\n";

        // Footer
        $receipt .= $this->centerText('Terima kasih!', $width) . "\n";
        $receipt .= $this->centerText('Kunjungi: www.brancoffee.com', $width) . "\n";
        $receipt .= str_repeat('-', $width) . "\n";

        return $receipt;
    }

    /**
     * Helper: Center text
     */
    private function centerText($text, $width)
    {
        $len = strlen($text);
        $pad = floor(($width - $len) / 2);
        return str_repeat(' ', $pad) . $text;
    }

    /**
     * Helper: Right align text
     */
    private function rightAlign($text, $width)
    {
        $len = strlen($text);
        $pad = $width - $len;
        return str_repeat(' ', $pad) . $text;
    }

    /**
     * Log print activity
     */
    private function logPrint(Transaction $transaction, $printerType)
    {
        if (!$transaction->invoice) {
            Invoice::create([
                'transaction_id' => $transaction->id,
                'invoice_number' => $transaction->transaction_code,
                'printer_type' => $printerType,
                'print_count' => 1,
                'printed_at' => now(),
            ]);
        } else {
            $transaction->invoice->increment('print_count');
            $transaction->invoice->update(['printed_at' => now()]);
        }
    }

    /**
     * Store Bluetooth print data
     */
    private function storeBluethoothPrintData(Transaction $transaction, $receiptText)
    {
        // Store in session or database for frontend retrieval
        // This can be improved based on your frontend implementation
        session()->put('bluetooth_print_data', [
            'transaction_id' => $transaction->id,
            'data' => $receiptText,
        ]);
    }
}
