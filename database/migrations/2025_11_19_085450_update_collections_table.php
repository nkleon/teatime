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
        Schema::table('collections', function(Blueprint $table){
            $table->foreignId('picker_id')->constrained('users');
            $table->foreignId('farm_id')->constrained('farms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collections', function(Blueprint $table){
            $table->dropConstrainedForeignId('picker_id');
            $table->dropConstrainedForeignId('farm_id');
        });
    }
};
