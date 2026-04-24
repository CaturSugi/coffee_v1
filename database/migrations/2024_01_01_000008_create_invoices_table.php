<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->unique()->constrained()->onDelete('cascade');
            $table->string('invoice_number', 100)->unique();
            $table->timestamp('printed_at')->nullable();
            $table->integer('print_count')->default(0);
            $table->enum('printer_type', ['thermal', 'bluetooth', 'pdf'])->default('thermal');
            $table->timestamps();

            $table->index('invoice_number');
            $table->index('printed_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
