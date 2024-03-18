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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->text('startup_id');
            $table->text('name');
            $table->text('email');
            $table->text('mobile');
            $table->text('department')->nullable();
            $table->text('position')->nullable();
            $table->text('address')->nullable();
            $table->text('gender');
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_join')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
