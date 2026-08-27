<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('collection', 30)->index();
            $table->string('slug', 80);
            $table->string('name', 80);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['collection', 'slug']);
        });

        $now = now();
        DB::table('categories')->insert([
            ['collection' => 'hommes', 'slug' => 'ensembles', 'name' => 'Ensembles', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'hommes', 'slug' => 'boubous', 'name' => 'Boubous', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'hommes', 'slug' => 'chemises', 'name' => 'Chemises', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'femmes', 'slug' => 'robes', 'name' => 'Robes', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'femmes', 'slug' => 'jupes', 'name' => 'Jupes', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['collection' => 'femmes', 'slug' => 'accessoires', 'name' => 'Accessoires', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
