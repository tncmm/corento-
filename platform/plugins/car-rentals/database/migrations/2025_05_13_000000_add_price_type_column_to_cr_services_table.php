<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('cr_services', 'price_type')) {
            return;
        }

        Schema::table('cr_services', function (Blueprint $table): void {
            $table->string('price_type')->default('once')->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('cr_services', function (Blueprint $table): void {
            $table->dropColumn('price_type');
        });
    }
};
