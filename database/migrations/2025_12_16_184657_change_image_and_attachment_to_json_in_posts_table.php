<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // We use text because SQLite doesn't have a native JSON type, 
            // and Laravel handles array casting from text/json columns automatically.
            $table->text('image')->nullable()->change();
            $table->text('attachment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->string('attachment')->nullable()->change();
        });
    }
};
