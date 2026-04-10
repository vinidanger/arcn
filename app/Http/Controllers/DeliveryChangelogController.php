<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeliveryChangelogController extends Controller
{
    public function __invoke()
    {
        // Multi-Cardápios
        try {
            $resp = Http::timeout(10)->get('https://license.arcn.com.br/app_delivery_license/api_packages.php');
            $packages = $resp->successful() ? ($resp->json() ?? []) : [];
        } catch (\Throwable $e) {
            Log::error('Changelog delivery: ' . $e->getMessage());
            $packages = [];
        }
        $packages = array_reverse($packages);

        // FlowPilot
        try {
            $resp2 = Http::timeout(10)->get('https://license.arcn.com.br/app_delivery_license/api_packages_manager.php?all=true');
            $flowPackages = ($resp2->successful() && $resp2->json('success')) ? ($resp2->json('packages') ?? []) : [];
        } catch (\Throwable $e) {
            Log::error('Changelog flowpilot: ' . $e->getMessage());
            $flowPackages = [];
        }
        $flowPackages = array_reverse($flowPackages);

        return view('changelog', compact('packages', 'flowPackages'));
    }
}
