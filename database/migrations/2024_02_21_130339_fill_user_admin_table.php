<?php

use App\Models\UserAdminModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        UserAdminModel::create([
            'role'                  => '0',
            'name'                  => 'Shuru-Up',
            'username'              => 'shuruup',
            'mobile'                => '9867052562',
            'email'                 => 'info@shuruup.com',
            'gender'                => 'Male',
            'password'              => Hash::make('Shuru@123'),
            'ask_password_change'   => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        UserAdminModel::truncate();
    }
};
