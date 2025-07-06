<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('cr_customers', 'balance')) {
            Schema::table('cr_customers', function (Blueprint $table) {
                $table->decimal('balance', 15, 2)->default(0);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('cr_customers', 'balance')) {
            Schema::table('cr_customers', function (Blueprint $table) {
                $table->dropColumn('balance');
            });
        }
    }
};
