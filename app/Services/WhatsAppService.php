<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class WhatsAppService
{
    /**
     * Generate WhatsApp link with the configured number and message
     *
     * @param string|null $customMessage Custom message to append to default message
     * @param string|null $roomName Room name to include in message
     * @return string|null Returns null if WhatsApp is disabled
     */
    public static function generateLink(?string $customMessage = null, ?string $roomName = null): ?string
    {
        $settings = Setting::getWhatsAppSettings();

        if (!$settings['is_whatsapp_enabled']) {
            return null;
        }

        $number = $settings['whatsapp_number'];
        $message = $settings['whatsapp_message'];

        if (empty($number)) {
            return null;
        }

        // Append room name if provided
        if ($roomName) {
            $message .= "\n\nKamar yang ditanyakan: {$roomName}";
        }

        // Append custom message if provided
        if ($customMessage) {
            $message .= "\n\n{$customMessage}";
        }

        // Encode message for URL
        $encodedMessage = rawurlencode($message);

        return "https://wa.me/{$number}?text={$encodedMessage}";
    }

    /**
     * Check if WhatsApp feature is enabled
     *
     * @return bool
     */
    public static function isEnabled(): bool
    {
        $settings = Setting::getWhatsAppSettings();
        return $settings['is_whatsapp_enabled'] && !empty($settings['whatsapp_number']);
    }

    /**
     * Get WhatsApp URL for public API
     *
     * @return array
     */
    public static function getPublicSettings(): array
    {
        $settings = Setting::getWhatsAppSettings();
        $isEnabled = $settings['is_whatsapp_enabled'] && !empty($settings['whatsapp_number']);

        return [
            'whatsapp_enabled' => $isEnabled,
            'whatsapp_url' => $isEnabled ? self::generateLink() : null,
        ];
    }
}
