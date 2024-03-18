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
        Schema::create('notify_wp', function (Blueprint $table) {
            $table->id();
            $table->text('type')->nullable()->comment('media,image,text ext.');
            $table->integer('trycount')->default(0);
            $table->integer('status')->default(0)->comment('0 Pending, 1 Sent, 2 Failed');
            $table->text('response_code')->nullable();
            $table->text('response')->nullable();
            $table->text('data')->nullable()->comment('Userdata');
            $table->text('campaignname')->nullable();
            $table->text('destination')->nullable();
            $table->text('username')->nullable();
            $table->text('params')->nullable()->comment('Message params');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify_wp');
    }
};
