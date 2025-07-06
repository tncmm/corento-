<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('cr_messages', function (Blueprint $table) {
            $table->string('phone', 60)->nullable();
            $table->string('status', 60)->default('unread');
        });
    }

    public function down(): void
    {
        Schema::table('cr_messages', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('status');
        });
    }
};
