<?php

use App\Models\SettingModel;
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
        $data = [
            ['item' => 'app_name', 'value' => 'Shuruup-Captable'],
            ['item' => 'smtp_mail_send_from', 'value' => ''],
            ['item' => 'smtp_mail_send_from_name', 'value' => ''],
            ['item' => 'smtp_mail_host', 'value' => ''],
            ['item' => 'smtp_mail_user', 'value' => ''],
            ['item' => 'smtp_mail_password', 'value' => ''],
            ['item' => 'smtp_mail_port', 'value' => '']
        ];


        foreach ($data as $key => $value) {
            SettingModel::create($value);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SettingModel::truncate();
    }
};
