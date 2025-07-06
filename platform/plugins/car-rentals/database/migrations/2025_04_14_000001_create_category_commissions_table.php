<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('cr_category_commissions')) {
            Schema::create('cr_category_commissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('car_category_id');
                $table->decimal('commission_percentage', 10)->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cr_category_commissions');
    }
};
