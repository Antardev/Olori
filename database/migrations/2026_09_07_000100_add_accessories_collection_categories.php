<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        DB::table('categories')->insertOrIgnore([
            ['collection' => 'accessoires', 'slug' => 'hommes', 'name' => 'Hommes', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'accessoires', 'slug' => 'femmes', 'name' => 'Femmes', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'accessoires', 'slug' => 'mixtes', 'name' => 'Mixtes', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        DB::table('categories')->where('collection', 'accessoires')->delete();
    }
};
