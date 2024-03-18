<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model{
    protected $settings;
    protected $keyValuePair;

    public function __construct(Collection $settings)
    {
        $this->settings = $settings;
        foreach ($settings as $setting){
            $this->keyValuePair[$setting->item] = $setting->value;
        }
    }

    public function has(string $key){ /* check key exists */ }
    public function contains(string $key){ /* check value exists */ }
    public function get(string $key){ return $this->keyValuePair[$key]; }
}
