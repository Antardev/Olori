<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->unique();
            $table->unsignedTinyInteger('discount_percent');
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->unsignedInteger('uses_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('promotions')->insert([
            ['code' => 'ETE2026', 'discount_percent' => 15, 'starts_at' => '2026-07-01', 'ends_at' => '2026-08-31', 'uses_count' => 23, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BIENVENUE', 'discount_percent' => 10, 'starts_at' => null, 'ends_at' => null, 'uses_count' => 112, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FETES2025', 'discount_percent' => 20, 'starts_at' => '2025-12-01', 'ends_at' => '2025-12-31', 'uses_count' => 87, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
