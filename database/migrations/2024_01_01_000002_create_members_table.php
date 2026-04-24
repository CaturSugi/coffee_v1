<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('member_code', 50)->unique();
            $table->string('member_phone', 20)->nullable();
            $table->string('member_email')->nullable();
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->integer('points_balance')->default(0);
            $table->decimal('total_spent', 12, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('member_code');
            $table->index('member_phone');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
};
