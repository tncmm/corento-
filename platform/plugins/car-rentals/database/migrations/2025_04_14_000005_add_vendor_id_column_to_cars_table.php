<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('cr_cars', 'vendor_id')) {
            Schema::table('cr_cars', function (Blueprint $table) {
                $table->foreignId('vendor_id')->nullable()->after('author_type');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('cr_cars', 'vendor_id')) {
            Schema::table('cr_cars', function (Blueprint $table) {
                $table->dropColumn('vendor_id');
            });
        }
    }
};
