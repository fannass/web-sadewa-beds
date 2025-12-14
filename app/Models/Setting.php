<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null): mixed
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear cache
        Cache::forget("setting.{$key}");
    }

    /**
     * Get all WhatsApp related settings
     *
     * @return array
     */
    public static function getWhatsAppSettings(): array
    {
        return Cache::remember('settings.whatsapp', 3600, function () {
            return [
                'whatsapp_number' => static::get('whatsapp_number', ''),
                'whatsapp_message' => static::get('whatsapp_message', ''),
                'is_whatsapp_enabled' => static::get('is_whatsapp_enabled', 'false') === 'true',
            ];
        });
    }

    /**
     * Clear all WhatsApp settings cache
     *
     * @return void
     */
    public static function clearWhatsAppCache(): void
    {
        Cache::forget('settings.whatsapp');
        Cache::forget('setting.whatsapp_number');
        Cache::forget('setting.whatsapp_message');
        Cache::forget('setting.is_whatsapp_enabled');
    }
}
