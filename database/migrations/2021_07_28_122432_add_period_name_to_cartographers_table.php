<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodNameToCartographersTable extends Migration
{
    public function up(): void
    {
        Schema::table('cartographers', function (Blueprint $table) {
            $table->string('period_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cartographers', function (Blueprint $table) {
            $table->dropColumn('period_name');
        });
    }
}
