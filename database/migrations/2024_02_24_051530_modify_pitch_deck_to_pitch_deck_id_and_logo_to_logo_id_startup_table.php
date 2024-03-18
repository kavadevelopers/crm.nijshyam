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
        Schema::table('startup', function (Blueprint $table) {
            $table->renameColumn('pitch_deck', 'pitch_deck_id');
            $table->renameColumn('logo', 'logo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('startup', function (Blueprint $table) {
            $table->renameColumn('pitch_deck_id', 'pitch_deck');
            $table->renameColumn('logo_id', 'logo');
        });
    }
};
