<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('cr_customer_revenues')) {
            Schema::create('cr_customer_revenues', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id');
                $table->foreignId('booking_id')->nullable();
                $table->decimal('sub_amount', 15);
                $table->decimal('fee', 15);
                $table->decimal('amount', 15);
                $table->decimal('current_balance', 15, 2)->default(0);
                $table->string('currency', 120);
                $table->text('description')->nullable();
                $table->foreignId('user_id')->nullable();
                $table->string('type', 60)->default('add-amount');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cr_customer_revenues');
    }
};
