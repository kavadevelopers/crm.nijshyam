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
        Schema::create('_verification_codes', function (Blueprint $table) {
            $table->id();
            $table->text('user_id')->nullable();
            $table->text('user_type')->nullable()->comment('(1 admin, 2 startup)');
            $table->text('code_type')->nullable();
            $table->string('code',10)->nullable();
            $table->boolean('is_used')->default(0);
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_verification_codes');
    }
};
