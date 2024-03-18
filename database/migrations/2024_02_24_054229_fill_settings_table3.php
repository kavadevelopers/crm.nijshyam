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
            ['item' => 'file_image_max_size', 'value' => '10'],
            ['item' => 'file_image_extensions_allowed', 'value' => 'jpg,png,jpeg,JPG,JPEG,PNG'],
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
        $data = [
            ['item' => 'file_image_max_size', 'value' => '10'],
            ['item' => 'file_image_extensions_allowed', 'value' => 'jpg,png,jpeg,JPG,JPEG,PNG'],
        ];

        foreach ($data as $key => $value) {
            SettingModel::where('item',$value['item'])->delete();
        }
    }
};
