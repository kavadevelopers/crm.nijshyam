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
        Schema::create('startup', function (Blueprint $table) {
            $table->id();
            $table->text('brand_name');
            $table->text('legal_name');
            $table->text('sector')->nullable();
            $table->text('short_description')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('contry')->nullable();
            $table->text('address')->nullable();
            $table->text('pincode')->nullable();
            $table->text('pitch_deck')->nullable();
            $table->text('logo')->nullable();
            $table->text('cin')->nullable();
            $table->date('date_of_incorporation')->nullable();
            $table->integer('status')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->text('created_by')->nullable();
            $table->text('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startup');
    }
};
