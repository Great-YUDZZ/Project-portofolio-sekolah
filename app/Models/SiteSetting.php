<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }

        $decoded = json_decode($setting->value, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $setting->value;
    }

    public static function set(string $key, $value, string $group = 'general'): self
    {
        $storedValue = is_array($value) ? json_encode($value) : (string)$value;
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $storedValue, 'group' => $group]
        );
    }
}
