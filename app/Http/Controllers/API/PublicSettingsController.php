<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\WhatsAppService;

class PublicSettingsController extends Controller
{
    /**
     * Get public settings (WhatsApp configuration)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $settings = WhatsAppService::getPublicSettings();

        return response()->json($settings);
    }
}
