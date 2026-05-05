<?php

use App\Services\BrandingAssetGenerator;
use App\Services\ServiceHealthRefresher;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('service-health:refresh', function () {
    app(ServiceHealthRefresher::class)->refresh();
    $this->info('Status dos serviços gravado no banco.');
})->purpose('Mede HTTP dos endpoints e atualiza a tabela service_health_entries (uso manual / debug).');

Artisan::command('branding:generate', function () {
    try {
        foreach (BrandingAssetGenerator::defaultPaths()->generate() as $relative) {
            $this->line($relative);
        }
    } catch (Throwable $e) {
        $this->error($e->getMessage());

        return 1;
    }
    $this->info('Assets gerados em public/images a partir de storage/app/public/images/logo.png.');

    return 0;
})->purpose('Gera favicons, ícones touch/PWA e imagens Open Graph a partir do logo em storage.');
