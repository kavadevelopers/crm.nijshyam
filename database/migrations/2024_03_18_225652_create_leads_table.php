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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->enum('priority',['High','Medium','Low'])->default('Medium');
            $table->text('status_id')->nullable();
            $table->text('source_id')->nullable();
            $table->text('lead_id')->nullable();
            $table->text('product_id')->nullable();
            $table->text('name');
            $table->text('mobile')->nullable();
            $table->text('email')->nullable();
            $table->text('city')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
