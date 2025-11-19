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
        Schema::table('payments', function(Blueprint $table){
            $table->foreignId('collection_id')->constrained('collections');
            $table->foreignId('method_id')->constrained('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function(Blueprint $table){
            $table->dropConstrainedForeignId('collection_id');
            $table->dropConstrainedForeignId('method_id');
        });
    }
};
